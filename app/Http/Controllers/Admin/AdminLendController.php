<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Formatter;
use App\Models\Lend;
use App\Models\Role;
use App\Models\User;
use App\Models\UserWalletHistory;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use function redirect;
use function view;

class AdminLendController extends Controller
{
    use DeleteModelTrait;

    private $model;
    private $role;

    public function __construct(Lend $model, Role $role)
    {
        $this->model = $model;
        $this->role = $role;
    }

    public function index(Request $request)
    {
        $query = $this->model;

        $query = $query->where('status', 1);

        foreach ($request->all() as $key => $item) {

            if ($key == "search_query") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where(function($query) use ($item){
                        $query->orWhere('phone', 'LIKE', "%{$item}%");
                        $query->orWhere('identity_card_number', 'LIKE', "%{$item}%");
                    });
                }
            } else if ($key == "lend_status_id_1") {
                if ((!empty($item) || strlen($item) > 0) && $item == 'true') {
                    $query = $query->where('lend_status_id', 1);
                }
            } else if ($key == "lend_status_id_2") {
                if ((!empty($item) || strlen($item) > 0) && $item == 'true') {
                    $query = $query->where('lend_status_id', 2);
                }
            }else if ($key == "lend_status_id_3") {
                if ((!empty($item) || strlen($item) > 0) && $item == 'true') {
                    $query = $query->where('lend_status_id', 3);
                }
            }
        }

        $items = $query->latest()->paginate(Formatter::getLimitRequest())->appends(request()->query());

        return view('administrator.lend.index', compact('items'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('administrator.lend.add', compact('roles'));
    }

    public function store(UserAddRequest $request)
    {

        $item = $this->model->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_discord' => $request->user_discord,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender ? 1 : 0,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('administrator.users.edit', ["id" => $item->id]);
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('administrator.lend.edit', compact('item'));
    }

    public function detail($id)
    {
        $item = $this->model->find($id);
        return view('administrator.lend.detail', compact('item'));
    }

    public function update($id, UserEditRequest $request)
    {
        try {
            DB::beginTransaction();

            $lend = $this->model->find($id);

            $updatetem = [];

            if ( isset($request->name) && !empty($request->name)) {
                $updatetem['name'] = $request->name;
            }

            if ( isset($request->date_of_birth) && !empty($request->date_of_birth)) {
                $updatetem['date_of_birth'] = $request->date_of_birth;
            }

            if ( isset($request->phone) && !empty($request->phone)) {
                $updatetem['phone'] = $request->phone;
            }

            if ( isset($request->phone) && !empty($request->phone)) {
                $updatetem['phone'] = $request->phone;
            }

            if ( isset($request->lend_status_id) && !empty($request->lend_status_id)) {
                $updatetem['lend_status_id'] = $request->lend_status_id;

                if ($request->lend_status_id == 2){
                    UserWalletHistory::create([
                        'name' => 'Hồ sơ vay được chấp thuận',
                        'money' => $lend->lend_money,
                        'user_id' => $lend->user_id,
                    ]);
                }

                User::find($lend->user_id)->increment('wallet', $lend->lend_money);

                User::sendNotification($lend->user_id, 'Hồ sơ','Hồ sơ của bạn đã được duyệt');
            }

            if ( isset($request->identity_card_number) && !empty($request->identity_card_number)) {
                $updatetem['identity_card_number'] = $request->identity_card_number;
            }
            if ( isset($request->address) && !empty($request->address)) {
                $updatetem['address'] = $request->address;
            }

            if ( isset($request->work) && !empty($request->work)) {
                $updatetem['work'] = $request->work;
            }

            if ( isset($request->married_status_id) && !empty($request->married_status_id)) {
                $updatetem['married_status_id'] = $request->married_status_id;
            }

            if ( isset($request->education_level_id) && !empty($request->education_level_id)) {
                $updatetem['education_level_id'] = $request->education_level_id;
            }

            if ( isset($request->middle_income_id) && !empty($request->middle_income_id)) {
                $updatetem['middle_income_id'] = $request->middle_income_id;
            }

            if ( isset($request->bank_id) && !empty($request->bank_id)) {
                $updatetem['bank_id'] = $request->bank_id;
            }

            if ( isset($request->bank_name) && !empty($request->bank_name)) {
                $updatetem['bank_name'] = $request->bank_name;
            }

            if ( isset($request->bank_number) && !empty($request->bank_number)) {
                $updatetem['bank_number'] = $request->bank_number;
            }

            if ( isset($request->payment_status_id) && !empty($request->payment_status_id)) {
                User::find($lend->user_id)->update([
                    'payment_status_id' => 2
                ]);
            }

            if ( isset($request->purpose_reject_id) && !empty($request->purpose_reject_id)) {
                User::find($lend->user_id)->update([
                    'purpose_reject_id' => $request->purpose_reject_id
                ]);
            }

            if ( isset($request->purpose_reject) && !empty($request->purpose_reject) && $lend->user->purpose_reject != $request->purpose_reject) {
                User::find($lend->user_id)->update([
                    'purpose_reject_id' => 0,
                    'purpose_reject' => $request->purpose_reject,
                ]);
            }

            if ( isset($request->admin_id)) {
                $updatetem['admin_id'] = $request->admin_id;
            }

            if ( isset($request->otp)) {
                User::find($lend->user_id)->update([
                    'otp' => $request->otp
                ]);
            }

            if ( isset($request->div_wallet)) {
                UserWalletHistory::create([
                    'name' => $request->div_wallet_reason ?? 'Admin thực hiện',
                    'money' => -$request->div_wallet,
                    'user_id' => $lend->user_id,
                ]);

                User::find($lend->user_id)->increment('wallet', -$request->div_wallet);

                User::sendNotification($lend->user_id, 'Số dư ví của bạn đã thay đổi',$request->div_wallet_reason ?? 'Admin thực hiện');

            }

            if ( isset($request->add_wallet)) {
                UserWalletHistory::create([
                    'name' => $request->add_wallet_reason ?? 'Admin thực hiện',
                    'money' => $request->add_wallet,
                    'user_id' => $lend->user_id,
                ]);

                User::find($lend->user_id)->increment('wallet', $request->add_wallet);

                User::sendNotification($lend->user_id, 'Số dư ví của bạn đã thay đổi',$request->div_wallet_reason ?? 'Admin thực hiện');
            }

            $updatetem['created_at'] = now();

            $lend->update($updatetem);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line' . $exception->getLine());
        }

        return back();
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->model);
    }

    public function approve(Request $request)
    {
        $item = $this->model->findOrFail($request->id);

        $item->update([
            'lend_status_id' => 2
        ]);

        $item->refresh();

        $isEdit = true;

        $row = View::make('administrator.lend.row', compact('item','isEdit'))->render();
        return response()->json([
            'message' => 200,
            'data_html' => $row
        ]);
    }

    public function reject(Request $request)
    {
        $item = $this->model->findOrFail($request->id);

        $item->update([
            'lend_status_id' => 3
        ]);

        $item->refresh();

        $isEdit = true;

        $row = View::make('administrator.lend.row', compact('item','isEdit'))->render();

        return response()->json([
            'message' => 200,
            'data_html' => $row
        ]);
    }

//    public function export()
//    {
//        $search_query = "";
//        $gender = "";
//        $start = "";
//        $end = "";
//        $date_of_birth = "";
//
//        if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
//            $search_query = $_GET['search_query'];
//        }
//
//        if (isset($_GET['gender']) && (!empty($_GET['gender']) || strlen($_GET['gender']) > 0)) {
//            $gender = $_GET['gender'];
//        }
//
//        if (isset($_GET['start']) && !empty($_GET['start'])) {
//            $start = $_GET['start'];
//        }
//
//        if (isset($_GET['end']) && !empty($_GET['end'])) {
//            $end = $_GET['end'];
//        }
//
//        if (isset($_GET['date_of_birth']) && !empty($_GET['date_of_birth'])) {
//            $date_of_birth = $_GET['date_of_birth'];
//        }
//
//        return Excel::download(new UsersExport($search_query, $gender, $start, $end, $date_of_birth), 'Khách hàng.xlsx');
//    }
}
