<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ChaoPro;
use App\ChaoDep;

use App\Http\Requests\ProCreateRequest;
use App\Http\Requests\ProUpdateRequest;
use Auth;

class ProController extends Controller
{
    protected $fields = [
        'proid' => '',
        'proname' => '',
        'proimg' => '',
        'depid'=>'',
        'rebellion' =>'1',

    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pros = ChaoPro::all();
        return view('admin.pro.index')->withPros($pros);
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
        $data['depts']=ChaoDep::all();
        return view('admin.pro.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProCreateRequest $request)
    {
        $pro = new ChaoPro();
        foreach (array_keys($this->fields) as $field) {
            $pro->$field = $request->get($field);
        }
        if (!$request->get('rebellion')){
            $pro->rebellion=1;
        }
        $pro->save();

        return redirect('/admin/pro')
                        ->withSuccess("栏目 '$pro->proname' 新建成功.");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pro = ChaoPro::findOrFail($id);
        $data = ['id' => $id];
        $data['depts']=ChaoDep::all();
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $pro->$field);
        }

        return view('admin.pro.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProUpdateRequest $request, $id)
    {
        $pro = ChaoPro::findOrFail($id);

        foreach (array_keys($this->fields) as $field) {
            $pro->$field = $request->get($field);
        }

        $pro->save();

        return redirect("/admin/pro/$id/edit")
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
        $pro = ChaoPro::findOrFail($id);
        $pro->delete();

        return redirect('/admin/pro')
                        ->withSuccess("'$pro->proname' .已经被删除.");
    }

    public function pros(){
        return Auth::user()->ChaoPros;
        //return ChaoPro::all()->toJson();
    }

}
