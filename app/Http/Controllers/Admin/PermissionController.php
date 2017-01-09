<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('admin.permission.index')->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission=new Permission();
        return view('admin.permission.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name=$request->name;
        $permission->label=$request->label;
        $permission->description= $request->description;
        $permission->save();

        return redirect('/admin/permission')
                        ->withSuccess("权限 '$permission->name' 新建成功.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit', compact('permission'));
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
        $permission = Permission::findOrFail($id);
        $permission->name=$request->name;
        $permission->label=$request->label;
        $permission->description= $request->description;

        $permission->save();

        return redirect("/admin/permission/$id/edit")
                        ->withSuccess("权限 '$permission->name' 更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect('/admin/permission')
                        ->withSuccess("权限 '$permission->name' .已经被删除.");
    }
}
