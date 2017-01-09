<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ChaoDep;

class DeptController extends Controller
{

    protected $fields = [
        'depname' => '',
        'depid' => '',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depts = ChaoDep::all();
        return view('admin.dept.index')->withDepts($depts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }

        return view('admin.dept.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dept = new ChaoDep();
        foreach (array_keys($this->fields) as $field) {
            $dept->$field = $request->get($field);
        }
        $dept->save();

        return redirect('/admin/dept')
                        ->withSuccess("栏目 '$dept->depname' 新建成功.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dept = ChaoDep::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $dept->$field);
        }

        return view('admin.dept.edit', $data);
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
        $dept = ChaoDep::findOrFail($id);

        foreach (array_keys($this->fields) as $field) {
            $dept->$field = $request->get($field);
        }

        $dept->save();

        return redirect("/admin/dept")
                        ->withSuccess("更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = ChaoDep::findOrFail($id);
        $dept->delete();

        return redirect('/admin/dept')
                        ->withSuccess("'$dept->depname' .已经被删除.");
    }
}
