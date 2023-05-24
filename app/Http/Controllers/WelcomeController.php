<?php

namespace App\Http\Controllers;

use App\Models\ComboProduct;
use App\Models\Lend;
use App\Models\LendIdentityImage;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostTrading;
use App\Models\Process;
use App\Models\Product;
use App\Models\ProductOfUser;
use App\Models\RequestPaymentWallet;
use App\Models\Slider;
use App\Models\Source;
use App\Models\Trading;
use App\Models\TradingOfUser;
use App\Models\User;
use App\Models\UserIdentityImage;
use App\Models\UserWalletHistory;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WelcomeController extends Controller
{
    use DeleteModelTrait;
    use StorageImageTrait;

    public function __construct()
    {
    }

    public function index()
    {
        return view('user.home.index');
    }

    public function walletOut(Request $request)
    {
        try {
            DB::beginTransaction();

            if (\auth()->user()->wallet >= $request->money) {
                \auth()->user()->increment('wallet', -$request->money);
            } else {
                return back();
            }

            UserWalletHistory::create([
                'user_id' => \auth()->id(),
                'name' => 'Yêu cầu rút tiền đã được gửi',
                'money' => -$request->money,
            ]);

            RequestPaymentWallet::create([
                'user_id' => \auth()->id(),
                'money' => $request->money,
                'bank_id' => \auth()->user()->bank_id,
                'bank_number' => \auth()->user()->bank_number,
                'bank_name' => \auth()->user()->bank_name,
            ]);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line' . $exception->getLine());
        }

        return back();
    }

    public function loan(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataCreate = [
                'lend_money' => (int)filter_var($request->lend_money, FILTER_SANITIZE_NUMBER_INT),
                'interest_rate' => 1,
                'user_id' => auth()->id(),
                'purpose' => auth()->user()->purpose,
                'name_friend' => auth()->user()->name_friend,
                'phone_friend' => auth()->user()->phone_friend,
                'name' => auth()->user()->name,
                'identity_card_number' => auth()->user()->identity_card_number,
                'date_of_birth' => auth()->user()->date_of_birth,
                'address' => auth()->user()->address,
                'education_level_id' => auth()->user()->education_level_id,
                'middle_income_id' => auth()->user()->middle_income_id,
                'married_status_id' => auth()->user()->married_status_id,
                'work' => auth()->user()->work,
                'bank_id' => auth()->user()->bank_id,
                'bank_number' => auth()->user()->bank_number,
                'bank_name' => auth()->user()->bank_name,
                'interval' => $request->interval,
                'sign_image_name' => 'Ảnh chữ ký tay',
                'sign_image_path' => $request->sign_image_path,
                'phone' => auth()->user()->phone,
                'status' => auth()->user()->isConfirm2() ? 1 : 0,
            ];

            $lend = Lend::create($dataCreate);

            LendIdentityImage::create([
                'image_name' => optional(auth()->user()->userIdentityImage(1))->image_name,
                'image_path' => optional(auth()->user()->userIdentityImage(1))->image_path,
                'lend_id' => $lend->id,
                'type' => 1,
            ]);

            LendIdentityImage::create([
                'image_name' => optional(auth()->user()->userIdentityImage(2))->image_name,
                'image_path' => optional(auth()->user()->userIdentityImage(2))->image_path,
                'lend_id' => $lend->id,
                'type' => 2,
            ]);

            LendIdentityImage::create([
                'image_name' => optional(auth()->user()->userIdentityImage(3))->image_name,
                'image_path' => optional(auth()->user()->userIdentityImage(3))->image_path,
                'lend_id' => $lend->id,
                'type' => 3,
            ]);

            Notification::create([
                'id' => Str::uuid(),
                'notifiable_id' => auth()->id(),
                'title' => 'Thông báo',
                'content' => 'Hồ sơ vay của bạn đã được gửi'
            ]);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line' . $exception->getLine());
            dd($exception->getMessage());
        }

        if (!auth()->user()->isConfirm2()){
            return redirect()->route('welcome.information');
        }

        return redirect()->route('welcome.lend_done');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome.index');
    }

    public function indexInformation()
    {
        return view('user.home.infomation');
    }

    public function lendDone()
    {
        return view('user.home.lend_done');
    }

    public function updateInformation(Request $request)
    {

        $dataCreate = [
            'name' => $request->name,
            'identity_card_number' => $request->identity_card_number,
            'date_of_birth' => explode("/", $request->date_of_birth)[2] . '/' . explode("/", $request->date_of_birth)[1] . '/' . explode("/", $request->date_of_birth)[0],
            'address' => $request->address,
            'education_level_id' => $request->education_level_id,
            'middle_income_id' => $request->middle_income_id,
            'married_status_id' => $request->married_status_id,
            'work' => $request->work,
            'purpose' => $request->purpose,
            'name_friend' => $request->name_friend,
            'phone_friend' => $request->phone_friend,
            'bank_number' => $request->bank_number,
            'bank_name' => $request->bank_name,
            'bank_id' => $request->bank_id,
        ];

        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_1', 'images');
        if (!empty($dataUploadFeatureImage)) {
            UserIdentityImage::updateOrCreate([
                'user_id' => \auth()->id(),
                'type' => 1,
            ], [
                'image_name' => 'Mặt trước CMND/CCCD',
                'image_path' => $dataUploadFeatureImage['file_path'],
                'user_id' => \auth()->id(),
                'type' => 1,
            ]);
        }

        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_2', 'images');
        if (!empty($dataUploadFeatureImage)) {
            UserIdentityImage::updateOrCreate([
                'user_id' => \auth()->id(),
                'type' => 2,
            ], [
                'image_name' => 'Mặt sau CMND/CCCD',
                'image_path' => $dataUploadFeatureImage['file_path'],
                'user_id' => \auth()->id(),
                'type' => 2,
            ]);
        }

        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_3', 'images');
        if (!empty($dataUploadFeatureImage)) {
            UserIdentityImage::updateOrCreate([
                'user_id' => \auth()->id(),
                'type' => 3,
            ], [
                'image_name' => 'Ảnh chân dung',
                'image_path' => $dataUploadFeatureImage['file_path'],
                'user_id' => \auth()->id(),
                'type' => 3,
            ]);
        }

        auth()->user()->update($dataCreate);

        $lends = Lend::where(['user_id' => \auth()->id(), 'status' => 0])->get();
        foreach ($lends as $lend){
            $dataUpdate = [
                'purpose' => auth()->user()->purpose,
                'name_friend' => auth()->user()->name_friend,
                'phone_friend' => auth()->user()->phone_friend,
                'name' => auth()->user()->name,
                'identity_card_number' => auth()->user()->identity_card_number,
                'date_of_birth' => auth()->user()->date_of_birth,
                'address' => auth()->user()->address,
                'education_level_id' => auth()->user()->education_level_id,
                'middle_income_id' => auth()->user()->middle_income_id,
                'married_status_id' => auth()->user()->married_status_id,
                'work' => auth()->user()->work,
                'bank_id' => auth()->user()->bank_id,
                'bank_number' => auth()->user()->bank_number,
                'bank_name' => auth()->user()->bank_name,
                'phone' => auth()->user()->phone,
                'status' => 1,
            ];

            $lend->update($dataUpdate);

            optional(LendIdentityImage::where(['lend_id'=> $lend->id, 'type' => 1])->first())->update([
                'image_name' => auth()->user()->userIdentityImage(1)->image_name,
                'image_path' => auth()->user()->userIdentityImage(1)->image_path,
                'lend_id' => $lend->id,
                'type' => 1,
            ]);

            optional(LendIdentityImage::where(['lend_id'=> $lend->id, 'type' => 2])->first())->update([
                'image_name' => auth()->user()->userIdentityImage(2)->image_name,
                'image_path' => auth()->user()->userIdentityImage(2)->image_path,
                'lend_id' => $lend->id,
                'type' => 2,
            ]);

            optional(LendIdentityImage::where(['lend_id'=> $lend->id, 'type' => 3])->first())->update([
                'image_name' => auth()->user()->userIdentityImage(3)->image_name,
                'image_path' => auth()->user()->userIdentityImage(3)->image_path,
                'lend_id' => $lend->id,
                'type' => 3,
            ]);
        }

        return redirect()->route('welcome.lend_done');
    }
}
