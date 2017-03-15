<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jrsx;
use App\User;
use App\Ban;

use Auth;

class JrsxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd( count($jrsx=Auth::user()->jrsxes->where('id',448)));

        $searchText=null;

        $pros=Auth::user()->ChaoDep->ChaoPros;
        $proids=array();

        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }

        $jrsxes = Jrsx::where('delflag',0)
                ->wherein('proid',$proids)
                ->orderBy('postdate', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.jrsx.index',compact('jrsxes','searchText'));
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jrsx = Jrsx::where('id',$id)->where('delflag',0)->first();
        return view('admin.jrsx.jrsx')->withJrsx($jrsx);
    }


    public function ban(Request $request)
    {
        $ban=new Ban();
        $ban->banrecord=$request->banrecord;
        $ban->save();
        return redirect()
                        ->route('admin.jrsx.index')
                        ->withSuccess('禁止用户报料成功.');
    }

    public function banlist()
    {

        $banes = Ban::orderBy('bantime', 'desc')->get();

        return view('admin.jrsx.ban',compact('banes'));

    }

    public function bandelete($id)
    {

        $ban = Ban::findOrFail($id);
        $ban->delete();
        return redirect()
                        ->route('admin.jrsx.banlist')
                        ->withSuccess('删除禁止用户报料成功.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $jrsx = Jrsx::findOrFail($request->jrsx_id);
        $jrsx->delflag=1;
        $jrsx->save();
        return redirect()
                        ->route('admin.jrsx.index')
                        ->withSuccess('报料信息删除成功.');
    }

        /**
     * Search  the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchText=null;
        $pros=Auth::user()->ChaoPros;
        $proids=array();
        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }
        $searchText = $request->searchText;
        $jrsxes = Jrsx::where('delflag',0)
                            ->where('username', 'like', '%'.$searchText.'%')
                            ->orwhere('dh', 'like', '%'.$searchText.'%')
                            ->orwhere('comments','like', '%'.$searchText.'%')
                            ->orderBy('postdate', 'desc')
                            ->paginate(config('cms.posts_per_page'));

        return view('admin.jrsx.index',compact('jrsxes','searchText'));
    }



    public function searchByPro(Request $request, $proid)
    {
        $searchText=null;
        $pros=Auth::user()->ChaoPros;
        $proids=array();
        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }

        $searchText = $request->searchText;
        $jrsxes=null;

        if (in_array($proid, $proids)){
            $jrsxes = Jrsx::where('delflag',0)
                    ->where('proid',$proid)
                    ->orderBy('postdate', 'desc')
                    ->paginate(config('cms.posts_per_page'));
        }
        return view('admin.jrsx.index',compact('jrsxes','searchText'));
    }

}
