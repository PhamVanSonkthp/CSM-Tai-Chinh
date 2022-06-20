<?php

namespace App\Http\Controllers;

use App\Models\ComboProduct;
use App\Models\Post;
use App\Models\PostTrading;
use App\Models\Process;
use App\Models\Product;
use App\Models\ProductOfUser;
use App\Models\Slider;
use App\Models\Source;
use App\Models\Trading;
use App\Models\TradingOfUser;
use App\Models\UserIdentityImage;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function loan()
    {

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

    public function updateInformation(Request $request)
    {

        $dataCreate = [
            'name' => $request->name,
            'identity_card_number' => $request->identity_card_number,
            'date_of_birth' => explode("/",$request->date_of_birth)[2] . '/' . explode("/",$request->date_of_birth)[1] . '/' . explode("/",$request->date_of_birth)[0],
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
            ],[
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
            ],[
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
            ],[
                'image_name' => 'Ảnh chân dung',
                'image_path' => $dataUploadFeatureImage['file_path'],
                'user_id' => \auth()->id(),
                'type' => 3,
            ]);
        }

        auth()->user()->update($dataCreate);
        return view('user.home.index');
    }
}
