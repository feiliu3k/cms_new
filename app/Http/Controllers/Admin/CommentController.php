<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ChaoComment;
use App\ChaoSky;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchText=null;
        $chaoComments = ChaoComment::where('delflag',0)
                ->orderBy('ctime', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.comment.index',compact('chaoComments','searchText'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function verify($cid)
    {
        $chaoComment = ChaoComment::where('delflag',0)->findOrFail($cid);

        $chaoComment->verifyflag = (($chaoComment->verifyflag)==0) ? 1 : 0;

        $chaoComment->save();

        return redirect()
                        ->route('admin.comment.index')
                        ->withSuccess('评论审核标志修改成功.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cid)
    {
        $chaoComment = ChaoComment::where('delflag',0)->findOrFail($cid);
        return view('admin.comment.edit',compact('chaoComment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cid)
    {
        $chaoComment = ChaoComment::where('delflag',0)->findOrFail($cid);
        $chaoComment->comment=$request->comment;
        if ($request->verifyflag==1){
            $chaoComment->verifyflag=1;
        }else{
            $chaoComment->verifyflag=0;
        }

        $chaoComment->tipid=$request->tipid;

        $chaoComment->save();

        return redirect()
                        ->route('admin.comment.index')
                        ->withSuccess('评论修改成功.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cid)
    {
        $chaoComment = ChaoComment::findOrFail($cid);
        $chaoComment->delflag=1;

        $chaoComment->save();

        return redirect()
                        ->route('admin.comment.index')
                        ->withSuccess('评论修改成功.');

    }

    public function search(Request $request)
    {
        $searchText=$request->searchText;
        $chaoSkies=ChaoSky::where('delflag',0)->where('tiptitle', 'like', '%'.$request->searchText.'%')->get();
        $chaoSkyids=array();
        foreach ($chaoSkies as $chaoSky) {
            array_push($chaoSkyids, $chaoSky->tipid);
        }
        $chaoComments = ChaoComment::where('delflag',0)
                            ->where('userip', 'like', '%'.$searchText.'%')
                            ->orwhere('comment', 'like', '%'.$searchText.'%')
                            ->orwherein('tipid',$chaoSkyids)
                            ->orderBy('ctime', 'desc')
                            ->paginate(config('cms.posts_per_page'));

        return view('admin.comment.index',compact('chaoComments','searchText'));
    }


}
