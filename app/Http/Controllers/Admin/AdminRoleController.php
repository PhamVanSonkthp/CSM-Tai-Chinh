<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAddRequest;
use App\Http\Requests\RoleEditRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use function redirect;
use function view;

class AdminRoleController extends Controller
{
    use DeleteModelTrait;
    private $premission;
    private $role;

    public function __construct(Role $role, Permission $premission)
    {
        $this->role = $role;
        $this->premission = $premission;
    }

    public function index(){
        $roles = $this->role->paginate(10);
        return view('administrator.role.index', compact('roles'));
    }

    public function create(){
        $premissionsParent = $this->premission->where('parent_id' , 0)->orderBy('display_name')->get();
        return view('administrator.role.add' , compact('premissionsParent'));
    }

    public function store(RoleAddRequest $request){
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('administrator.roles.index');
    }

    public function edit($id){
        $premissionsParent = $this->premission->where('parent_id' , 0)->orderBy('display_name')->get();
        $role = $this->role->find($id);
        $permissionsChecked = $role->permissions;
        return view('administrator.role.edit' , compact('premissionsParent'  , 'role' , 'permissionsChecked'));
    }

    public function update($id , RoleEditRequest $request){
        $this->role->find($id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        $role = $this->role->find($id);

        $role->permissions()->sync($request->permission_id);
        return back();
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->role);
    }
}
