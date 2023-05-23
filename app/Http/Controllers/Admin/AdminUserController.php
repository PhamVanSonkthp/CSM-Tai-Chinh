<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Formatter;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use function redirect;
use function view;

class AdminUserController extends Controller
{
    use DeleteModelTrait;

    private $model;
    private $role;

    public function __construct(User $model, Role $role)
    {
        $this->model = $model;
        $this->role = $role;
    }

    public function index(Request $request)
    {
        $query = $this->model->where('is_admin', 0);

        foreach ($request->all() as $key => $item) {

            if ($key == "search_query") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where(function($query) use ($item){
                        $query->orWhere('name', 'LIKE', "%{$item}%");
                    });
                }
            } else if ($key == "gender") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where('gender_id', $item);
                }
            }
        }

        $items = $query->latest('users.created_at')->paginate(Formatter::getLimitRequest())->appends(request()->query());

        return view('administrator.user.index', compact('items'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('administrator.user.add', compact('roles'));
    }

    public function get(Request $request)
    {
        $item = User::find($request->id);

        $item['html'] = View::make('administrator.user.detail', compact('item'))->render();
        return response()->json($item);
    }

    public function updateAjax(Request $request)
    {
        $item = User::find($request->id);

        $item->update([
            "identity_card_number" => $request->identity_card_number,
            "address" => $request->address,
            "work" => $request->work,
            "married_status_id" => $request->married_status_id,
            "education_level_id" => $request->education_level_id,
            "middle_income_id" => $request->middle_income_id,
            "bank_id" => $request->bank_id,
            "bank_name" => $request->bank_name,
            "bank_number" => $request->bank_number,
        ]);

        return response()->json($item);
    }

    public function store(UserAddRequest $request)
    {

        $user = $this->model->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_discord' => $request->user_discord,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender ? 1 : 0,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('administrator.users.edit', ["id" => $user->id]);
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('administrator.user.edit', compact('item'));
    }

    public function update($id, UserEditRequest $request)
    {
        try {
            DB::beginTransaction();
            $updatetem = [];

            if (!empty($request->name)) {
                $updatetem['name'] = $request->name;
            }

            if (!empty($request->phone)) {
                $updatetem['phone'] = $request->phone;
            }

            if (!empty($request->date_of_birth)) {
                $updatetem['date_of_birth'] = $request->date_of_birth;
            }

            if (!empty($request->gender)) {
                $updatetem['gender'] = $request->gender ? 1 : 0;
            }

            if (!empty($request->email_verified_at)) {
                $updatetem['email_verified_at'] = $request->verify_email ? now() : null;
            }

            if (!empty($request->payment_status_id)) {
                $updatetem['payment_status_id'] = $request->payment_status_id;
            }

            if (!empty($request->user_status_id)) {
                $updatetem['user_status_id'] = $request->user_status_id;
            }


            if (!empty($request->password)) {
                $updatetem['password'] = Hash::make($request->password);
            }

            $this->model->find($id)->update($updatetem);

            $user = $this->model->find($id);
            $user->roles()->sync($request->role_id);
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
