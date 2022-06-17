<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Formatter;
use App\Models\Lend;
use App\Models\RequestPaymentWallet;
use App\Models\Role;
use App\Models\User;
use App\Models\UserWalletHistory;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function redirect;
use function view;

class AdminRequestPaymentWalletController extends Controller
{
    use DeleteModelTrait;

    private $model;

    public function __construct(RequestPaymentWallet $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $query = $this->model;

        foreach ($request->all() as $key => $item) {

            if ($key == "search_query") {
                if (!empty($item) || strlen($item) > 0) {

                    $query= $query->select('request_payment_wallets.*')
                        ->join('users', 'request_payment_wallets.user_id', '=', 'users.id');

                    $query = $query->where(function($query) use ($item){
                        $query->orWhere('users.name', 'LIKE', "%{$item}%");
                        $query->orWhere('phone', 'LIKE', "%{$item}%");
                        $query->orWhere('identity_card_number', 'LIKE', "%{$item}%");
                    });
                }
            } else if ($key == "status_request_payment_wallet_id_1") {
                if ((!empty($item) || strlen($item) > 0) && $item == 'true') {
                    $query = $query->where('status_request_payment_wallet_id', 1);
                }
            } else if ($key == "status_request_payment_wallet_id_2") {
                if ((!empty($item) || strlen($item) > 0) && $item == 'true') {
                    $query = $query->where('status_request_payment_wallet_id', 2);
                }
            }else if ($key == "status_request_payment_wallet_id_3") {
                if ((!empty($item) || strlen($item) > 0) && $item == 'true') {
                    $query = $query->where('status_request_payment_wallet_id', 3);
                }
            }
        }

        $items = $query->latest()->paginate(Formatter::getLimitRequest())->appends(request()->query());

        return view('administrator.request_payment_wallet.index', compact('items'));
    }

    public function create()
    {
        return view('administrator.request_payment_wallet.add');
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
        return view('administrator.request_payment_wallet.edit', compact('item'));
    }

    public function detail($id)
    {
        $item = $this->model->find($id);
        return view('administrator.request_payment_wallet.detail', compact('item'));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            $item = $this->model->find($id);

            $updatetem = [];

            if ( isset($request->status_request_payment_wallet_id)) {
                $updatetem['status_request_payment_wallet_id'] = $request->status_request_payment_wallet_id;
            }

            if ( isset($request->note)) {
                $updatetem['note'] = $request->note;
            }

            $item->update($updatetem);
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
