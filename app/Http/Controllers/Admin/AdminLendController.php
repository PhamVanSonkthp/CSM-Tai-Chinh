<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Formatter;
use App\Models\Lend;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

    public function update($id, UserEditRequest $request)
    {
        try {
            DB::beginTransaction();
            $updatetem = [
                'name' => $request->name,
                'phone' => $request->phone,
                'user_discord' => $request->user_discord,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender ? 1 : 0,
                'email_verified_at' => $request->verify_email ? now() : null,
            ];

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
