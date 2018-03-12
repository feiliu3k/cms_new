<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jrsx;
use App\JrsxRemark;

use Auth;

class RemarkController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd(Auth::user()->jrsxRemarks->where('jrsxid',447)->first()->remark);
        $searchText=null;
        // $jrsxRemarks = Auth::user()->jrsxRemarks;
        // dd($jrsxRemarks);
        $jrsxes = Auth::user()->jrsxesRemarks(Auth::user()->id)
                ->paginate(config('cms.posts_per_page'));
        //dd($jrsxes);

        return view('admin.jrsx.index',compact('jrsxes','searchText'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (JrsxRemark::where('jrsxid',$request->jrsx_id)->where('userid',Auth::user()->id)->first()){
            return back()->withErrors('备注创建失败！');
        }

        if ($request->remark==''){
            return back()->withErrors('备注不能为空！');
        }
        $jrsxremark = new JrsxRemark();
        $jrsxremark->userid=Auth::user()->id;
        $jrsxremark->remark=$request->remark;
        Jrsx::findOrFail($request->jrsx_id)->remarks()->save($jrsxremark);
        return redirect()
                        ->route('admin.remark.index')
                        ->withSuccess('备注创建成功！');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $jrsxremark=JrsxRemark::where('jrsxid',$request->jrsx_id)->where('userid',Auth::user()->id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->remark==''){
            return back()->withErrors('备注不能为空！');
        }
        $jrsxremark=JrsxRemark::findOrFail($request->jrsxremarkid);
        $jrsxremark->remark=$request->remark;
        $jrsxremark->save();
        return redirect()
                        ->route('admin.jrsx.index')
                        ->withSuccess('备注成功.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
