<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function redirect;
use function view;

class AdminEmployeeController extends Controller
{

    use DeleteModelTrait;
    private $user;
    private $role;
    private $invoice;
    private $product;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index(){

        $query = $this->user;

        if(isset($_GET['search_query'])){
            $query = $query->where('name', 'LIKE', "%{$_GET['search_query']}%");
        }

        $users = $query->latest()->paginate(10)->appends(request()->query());

        return view('administrator.employees.index' , compact('users'));
    }

    public function create(){
        $roles = $this->role->all();
        return view('administrator.employees.add' , compact('roles'));
    }

    public function detail($id){
        $user = $this->user->find($id);

        $query = $this->invoice->where('admin_id', $id);

        $products = $this->product->all();

//        $query = $query->where(function ($query) use ($products) {
//            foreach ($products as $productsItem) {
//                $query->orWhereJsonContains('product_ids', ['product_id' => strval($productsItem->id)]);
//            }
//        });

        if(isset($_GET['start']) && !empty('start')){
            $query = $query->whereDate('created_at', '>=', $_GET['start']);
        }

        if(isset($_GET['end']) && !empty('end')){
            $query = $query->whereDate('created_at', '<=', $_GET['end']);
        }

        $invoiceProducts = $query->latest()->paginate(10)->appends(request()->query());

        return view('administrator.employees.detail' , compact('user','invoiceProducts'));
    }

    public function store(UserAddRequest $request){
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=> Hash::make($request->password),
                'is_admin'=> 1,
            ]);

            $user->roles()->attach($request->role_id);

            DB::commit();

            return redirect()->route('administrator.employees.edit' , ["id" => $user->id]);
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line' . $exception->getLine());
        }

        return redirect()->route('administrator.employees.index');
    }

    public function edit($id){
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $rolesOfUser = $user->roles;
        return view('administrator.employees.edit' , compact('user' , 'roles' , 'rolesOfUser'));
    }

    public function update($id , UserEditRequest $request){
        try {
            DB::beginTransaction();
            $updatetem = [
//                'name'=>$request->name,
//                'email'=>$request->email,
//                'phone'=>$request->phone,
            ];

            if(!empty($request->password)){
                $updatetem['password'] = Hash::make($request->password);
            }

            $this->user->find($id)->update($updatetem);

            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line' . $exception->getLine());
        }

        return back();
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->user);
    }
}
