<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash, Input;
use App\User;
use App\Role;
use App\ChaoDep;
use App\ChaoPro;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts=ChaoDep::all();
        $user=new User();
        return view('admin.user.create',compact('user','depts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->dept_id= $request->dept_id;
        $user->password= Hash::make($request->newPassword);
        $user->save();

        return redirect('/admin/user')
                        ->withSuccess("用户 '$user->name' 新建成功.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depts=ChaoDep::all();
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user','depts'));
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
        $user = User::findOrFail($id);

        $user->name=$request->name;
        $user->email=$request->email;
        $user->dept_id= $request->dept_id;

        $user->save();

        return redirect("/admin/user/$id/edit")
                        ->withSuccess("用户 '$user->name' 更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/user')
                        ->withSuccess("用户 '$user->name' 已经被删除.");
    }


     /**
     * Change the user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change()
    {
        $input=Input::all();
        $id=$input['userid'];
        $user = User::findOrFail($id);
        if ($input['newpassword']==$input['password_confirmation']){
            $user->password=Hash::make($input['newpassword']);
            $user->save();
            return redirect("/admin/user/$id/edit")
                        ->withSuccess("密码成功.");
        }else{
            return redirect("/admin/user/$id/edit")
                        ->withSuccess("密码不一致.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRole($id)
    {
        $user = User::findOrFail($id);
        $ur=$user->roles;
        $userRoles=array();
        foreach ($ur as $role){
            $rid=$role->id;
            array_push($userRoles,$rid);
        }

        $roles = Role::all();

        return view('admin.user.roles', ['user'=>$user,'userRoles'=>$userRoles,'roles'=>$roles]);
    }


    public function updateRole(Request $request,$id)
    {
        //dd($request->permissions);
        $user = User::findOrFail($id);
        $roleids=$request->roles;

        $userRoleids=array();
        $user->roles()->detach();

        if (count($roleids)>0){
            foreach ($roleids as $roleid){
                $user->assignRole(Role::findOrFail($roleid)->name);
            }
        }
        return redirect('/admin/user')
                        ->withSuccess("用户 '$user->name' .角色更改成功！");

    }


    public function editPro($id)
    {
        $user = User::findOrFail($id);
        $up=$user->chaoPros;
        $userpros=array();
        foreach ($up as $pro){
            $pid=$pro->id;
            array_push($userpros,$pid);
        }

        $pros = ChaoPro::all();

        return view('admin.user.pros', ['user'=>$user,'userpros'=>$userpros,'pros'=>$pros]);
    }


    public function updatePro(Request $request,$id)
    {
        //dd($request->permissions);
        $user = User::findOrFail($id);
        $proids=$request->pros;

        $userProids=array();
        $user->chaoPros()->detach();

        if (count($proids)>0){
            foreach ($proids as $proid){
                $user->assignPro(ChaoPro::findOrFail($proid)->proname);
            }
        }
        return redirect('/admin/user')
                        ->withSuccess("用户 '$user->name' .角色更改成功！");

    }
}
