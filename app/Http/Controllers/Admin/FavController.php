<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jrsx;

use Auth;

class FavController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchText=null;
        $jrsxes = Auth::user()->jrsxes()->where('delflag',0)
                ->orderBy('postdate', 'desc')
                ->paginate(config('cms.posts_per_page'));
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
        $jrsx=Jrsx::findOrFail($request->jrsx_id);
        Auth::user()->jrsxes()->save($jrsx);
        return redirect()
                        ->route('admin.fav.index')
                        ->withSuccess('收藏成功.');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::user()->jrsxes()->detach($request->jrsx_id);
        return redirect()
                        ->route('admin.fav.index')
                        ->withSuccess('取消收藏成功.');
    }
}
