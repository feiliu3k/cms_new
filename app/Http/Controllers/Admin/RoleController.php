<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=new Role();
        return view('admin.role.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name=$request->name;
        $role->label=$request->label;
        $role->description= $request->description;
        $role->save();

        return redirect('/admin/role')
                        ->withSuccess("角色 '$role->name' 新建成功.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name=$request->name;
        $role->label=$request->label;
        $role->description= $request->description;

        $role->save();

        return redirect("/admin/role/$id/edit")
                        ->withSuccess("角色 '$role->name' 更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('/admin/role')
                        ->withSuccess("角色 '$role->name' .已经被删除.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPermission($id)
    {
        $role = Role::findOrFail($id);
        $rp=$role->permissions;
        $rolePermissions=array();
        foreach ($rp as $permission){
            $pid=$permission->id;
            array_push($rolePermissions,$pid);
        }

        $permissions = Permission::all();

        return view('admin.role.permissions', ['role'=>$role,'rolePermissions'=>$rolePermissions,'permissions'=>$permissions]);
    }


    public function updatePermission(Request $request,$id)
    {
        //dd($request->permissions);
        $role = Role::findOrFail($id);
        $permissionids=$request->permissions;
        $count=0;
        $rolePermissionids=array();
        $role->permissions()->detach();
        if (count($permissionids)>0){
            foreach ($permissionids as $permissionid){
                $role->givePermissionTo(Permission::findOrFail($permissionid));
                $count++;
            }
        }
        return redirect('/admin/role')
                        ->withSuccess("角色 '$role->name' .权限更改成功！");

    }
}
