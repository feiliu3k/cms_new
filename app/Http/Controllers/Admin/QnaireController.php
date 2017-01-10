<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\NewsFormFields;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\ChaoSky;
use App\ChaoPro;
use App\User;

use App\VoteTitle;
use App\VoteItem;
use App\InputTable;

use Auth, Image, DB;

use Carbon\Carbon;

class QnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchText=null;
        $pros=Auth::user()->ChaoPros;
        $proids=array();
        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }
        $chaoSkies = ChaoSky::where('delflag',0)
                ->wherein('proid',$proids)
                ->orderBy('toporder', 'desc')
                ->orderBy('stime', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.qnaire.index',compact('chaoSkies','searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // $data = $this->dispatch(new NewsFormFields());

       return view('admin.qnaire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$post = ChaoSky::create($request->postFillData());
        //dd($request->proid);

        $chaoSky = New ChaoSky();
        $chaoSky->tiptitle=$request->tiptitle;
        $chaoSky->tipimg1=$request->tipimg1;
        $chaoSky->tipcontent=$request->tipcontent;
        $chaoSky->tipvideo=$request->tipvideo;
        $chaoSky->readnum=$request->readnum;
         if($request->toporder=="true"){
            $chaoSky->toporder=1;
        }else{
            $chaoSky->toporder=0;
        }
        if($request->commentflag=="true"){
            $chaoSky->commentflag=1;
        }else{
            $chaoSky->commentflag=0;
        }
        if($request->draftflag=="true"){
            $chaoSky->draftflag=1;
        }else{
            $chaoSky->draftflag=0;
        }
        if($request->zanflag=="true"){
            $chaoSky->zanflag=1;
            $chaoSky->zannum=$request->zannum;
            $chaoSky->zanendtime=new Carbon($request->zan_end_date.' '.$request->zan_end_time);
        }else{
            $chaoSky->zanflag=0;
            $chaoSky->zannum=0;
            $chaoSky->zanendtime=new Carbon($request->zan_end_date.' '.$request->zan_end_time);
        }

        $chaoSky->stime=new Carbon($request->publish_date.' '.$request->publish_time
        );

        if ($request->voteflag=="true"){
            $chaoSky->voteflag=1;
            $chaoSky->vbtime=new Carbon($request->vote_begin_date.' '.$request->vote_begin_time);
            $chaoSky->vetime=new Carbon($request->vote_end_date.' '.$request->vote_end_time);
        }else{
            $chaoSky->voteflag=0;
            $chaoSky->vbtime=new Carbon($request->vote_begin_date.' '.$request->vote_begin_time);
            $chaoSky->vetime=new Carbon($request->vote_end_date.' '.$request->vote_end_time);
        }

        $chaoSky->proid=$request->proid;
        $chaoSky->userid=Auth::user()->id;
        $chaoSky->post_user=Auth::user()->id;

        $chaoSky->save();
        // todo 存储投票选项列表
        if ($chaoSky->voteflag){
            if ($request->vote_titles){
                foreach ($request->vote_titles as $vt){
                    $voteTitle = new voteTitle();
                    $voteTitle->votetitle=$vt['votetitle'];
                    $voteTitle->votenum=$vt['votenum'];
                    if($vt['aflag']){
                        $voteTitle->aflag=1;
                    }else
                    {
                        $voteTitle->aflag=0;
                    }

                    $chaoSky->voteTitles()->save($voteTitle);
                    if (isset($vt['vote_items']) and ($vt['vote_items'])){
                        foreach ($vt['vote_items'] as $vi) {
                            $voteItem = new VoteItem();
                            $voteItem->itemcontent=$vi['itemcontent'];
                            $voteItem->votecount=$vi['votecount'];
                            $voteItem->itemimg=$vi['itemimg'];
                            $voteItem->itemvideo=$vi['itemvideo'];
                            if($vi['rflag']){
                                $voteItem->rflag=1;
                            }else
                            {
                                $voteItem->rflag=0;
                            }
                            $voteTitle->voteItems()->save($voteItem);
                        }
                    }
                }
            }
            if ($request->input_tables){
                foreach ($request->input_tables as $it){
                    $inputTable = new InputTable();
                    $inputTable->inputname=$it['inputname'];
                    if($it['nullflag']){
                        $inputTable->nullflag=1;
                    }else
                    {
                        $inputTable->nullflag=0;
                    }

                    $chaoSky->inputTables()->save($inputTable);
                }
            }
        }

        return response()->json(['url'=>route('admin.qnaire.index'),'success'=>'文章添加成功']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chaoSky = ChaoSky::with('voteTitles','inputTables','voteTitles.voteItems')->findOrFail($id);
        $chaoSky['publish_date'] = $chaoSky->publish_date;
        $chaoSky['publish_time'] = $chaoSky->publish_time;
        $chaoSky['vote_begin_date'] = $chaoSky->vote_begin_date;
        $chaoSky['vote_begin_time'] = $chaoSky->vote_begin_time;
        $chaoSky['vote_end_date'] = $chaoSky->vote_end_date;
        $chaoSky['vote_end_time'] = $chaoSky->vote_end_time;
        $chaoSky['zan_end_date'] = $chaoSky->zan_date;
        $chaoSky['zan_end_time'] = $chaoSky->zan_time;
        return $chaoSky->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tipid)
    {

        $data = ChaoSky::findOrFail($tipid);

        return view('admin.qnaire.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, $tipid)
    {
        $chaoSky =ChaoSky::findOrFail($tipid);
        $chaoSky->tiptitle=$request->tiptitle;
        $chaoSky->tipimg1=$request->tipimg1;
        $chaoSky->tipcontent=$request->tipcontent;
        $chaoSky->tipvideo=$request->tipvideo;
        $chaoSky->readnum=$request->readnum;
        if($request->toporder=="true"){
            $chaoSky->toporder=1;
        }else{
            $chaoSky->toporder=0;
        }
        if($request->commentflag=="true"){
            $chaoSky->commentflag=1;
        }else{
            $chaoSky->commentflag=0;
        }
        if($request->draftflag=="true"){
            $chaoSky->draftflag=1;
        }else{
            $chaoSky->draftflag=0;
        }
        if($request->zanflag=="true"){
            $chaoSky->zanflag=1;
            $chaoSky->zannum=$request->zannum;
            $chaoSky->zanendtime=new Carbon($request->zan_end_date.' '.$request->zan_end_time);
        }else{
            $chaoSky->zanflag=0;
            $chaoSky->zannum=0;
            $chaoSky->zanendtime=new Carbon($request->zan_end_date.' '.$request->zan_end_time);
        }
        $chaoSky->stime=new Carbon($request->publish_date.' '.$request->publish_time
        );

        if ($request->voteflag=="true"){
            $chaoSky->voteflag=1;
            $chaoSky->vbtime=new Carbon($request->vote_begin_date.' '.$request->vote_begin_time);
            $chaoSky->vetime=new Carbon($request->vote_end_date.' '.$request->vote_end_time);
        }else{
            $chaoSky->voteflag=0;
            $chaoSky->vbtime=new Carbon($request->vote_begin_date.' '.$request->vote_begin_time);
            $chaoSky->vetime=new Carbon($request->vote_end_date.' '.$request->vote_end_time);
        }

        $chaoSky->proid=$request->proid;
        $chaoSky->userid=Auth::user()->id;
        $chaoSky->post_user=Auth::user()->id;

        if ($chaoSky->voteflag){

            if ($chaoSky->voteTitles){
                foreach ($chaoSky->voteTitles as $vt){
                    $vt->voteItems()->delete($vt->voteItems);
                }
                $chaoSky->voteTitles()->delete($chaoSky->voteTitles);
            }

            if ($request->vote_titles)
            {
                foreach ($request->vote_titles as $vt){
                    $voteTitle = new voteTitle();
                    $voteTitle->vtid=$vt['vtid'];
                    $voteTitle->votetitle=$vt['votetitle'];
                    $voteTitle->votenum=$vt['votenum'];
                    if($vt['aflag']){
                        $voteTitle->aflag=1;
                    }else
                    {
                        $voteTitle->aflag=0;
                    }

                    $chaoSky->voteTitles()->save($voteTitle);
                    if (isset($vt['vote_items']) and ($vt['vote_items'])){
                        foreach ($vt['vote_items'] as $vi) {
                            $voteItem = new VoteItem();
                            $voteItem->id=$vi['id'];
                            $voteItem->itemcontent=$vi['itemcontent'];
                            $voteItem->votecount=$vi['votecount'];
                            $voteItem->itemimg=$vi['itemimg'];
                            $voteItem->itemvideo=$vi['itemvideo'];
                            if($vi['rflag']){
                                $voteItem->rflag=1;
                            }else
                            {
                                $voteItem->rflag=0;
                            }
                            $voteTitle->voteItems()->save($voteItem);
                        }
                    }
                }
            }else
            {
                if ($chaoSky->voteTitles){
                    foreach ($chaoSky->voteTitles as $vt){
                        $vt->voteItems()->delete($vt->voteItems);
                    }
                    $chaoSky->voteTitles()->delete($chaoSky->voteTitles);
                }
                $chaoSky->voteflag=0;
            }
        }
        else{
            if ($chaoSky->voteTitles){
                foreach ($chaoSky->voteTitles as $vt){
                    $vt->voteItems()->delete($vt->voteItems);
                }
                $chaoSky->voteTitles()->delete($chaoSky->voteTitles);
            }
            $chaoSky->voteflag=0;
        }

        if ($chaoSky->inputTables){
            $chaoSky->inputTables()->delete($chaoSky->inputTables);
        }

        if (($chaoSky->voteflag) and ($request->input_tables)){
            foreach ($request->input_tables as $it){
                    $inputTable = new InputTable();
                    $inputTable->id=$it['id'];
                    $inputTable->inputname=$it['inputname'];
                    if($it['nullflag']){
                        $inputTable->nullflag=1;
                    }else
                    {
                        $inputTable->nullflag=0;
                    }

                    $chaoSky->inputTables()->save($inputTable);
            }
        }

        $chaoSky->save();



        return response()->json(['url'=>route('admin.qnaire.index'),'success'=>'文章添加成功']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = ChaoSky::findOrFail($id);

        $post->delflag=1;
        $post->save();
        return redirect()
                        ->route('admin.qnaire.index')
                        ->withSuccess('文章删除成功.');
    }


    // public function search(Request $request)
    // {
    //     $searchText = $request->searchText;
    //     $pros=ChaoPro::where('proname','like', '%'.$request->searchText.'%')->get();
    //     $users=User::where('name','like', '%'.$request->searchText.'%')->get();

    //     $ipros=Auth::user()->ChaoPros;
    //     $iproids=array();
    //     foreach ($ipros as $ipro) {
    //         array_push($iproids, $ipro->id);
    //     }

    //     $proids=array();
    //     foreach ($pros as $pro) {
    //         if (in_array($pro->id, $iproids)){
    //             array_push($proids, $pro->id);
    //         }
    //     }

    //     $userids=array();
    //     foreach ($users as $user) {
    //         array_push($userids, $user->id);
    //     }

    //     // $chaoSkies = ChaoSky::where('delflag',0)
    //     //                     ->where('tiptitle', 'like', '%'.$searchText.'%')
    //     //                     ->orwhere('tipcontent', 'like', '%'.$searchText.'%')
    //     //                     ->orwherein('proid',$proids)
    //     //                     ->orwherein('userid',$userids)
    //     //                     ->orderBy('stime', 'desc')->get();

    //     $chaoSkies=DB::select('SELECT s.*,p.proname,u.name username,pu.name postUser FROM chaosky s JOIN chaopro p ON s.proid=p.id JOIN users u ON u.id= s.userid LEFT JOIN users pu ON pu.id= s.post_user
    //         WHERE s.delflag=0 AND ( s.tiptitle LIKE ? OR s.tipcontent LIKE ? OR s.proid IN (SELECT pro_id FROM pro_user WHERE user_id=? and pro_id in (select id from chaopro where proname LIKE ? )) OR s.userid IN (SELECT id FROM users WHERE NAME LIKE ?)) ORDER BY s.toporder desc,s.stime desc ',['%'.$request->searchText.'%','%'.$request->searchText.'%',Auth::user()->id,'%'.$request->searchText.'%','%'.$request->searchText.'%']);
    //     //dd($chaoSkies);
    //    return view('admin.qnaire.search',compact('chaoSkies','searchText'));
    // }
    //

    /**
     * Search  the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchText = $request->searchText;

        $pros=Auth::user()->ChaoPros;
        $proids=array();
        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }

        $chaoSkies = ChaoSky::where('delflag',0)
                            ->wherein('proid',$proids)
                            ->where(function ($query) use ($searchText)
                            {
                                $query->where('tiptitle', 'like', '%'.$searchText.'%')
                                      ->orwhere('tipcontent', 'like', '%'.$searchText.'%');
                            })
                            ->orderBy('stime', 'desc')->get();

        return view('admin.news.search',compact('chaoSkies','searchText'));
    }

    public function searchByPro($proid)
    {
        $searchText=null;
        $pros=Auth::user()->ChaoPros;
        $proids=array();
        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }

        $chaoSkies=null;

        if (in_array($proid, $proids)){
            $chaoSkies = ChaoSky::where('delflag',0)
                    ->where('proid',$proid)
                    ->orderBy('stime', 'desc')
                    ->paginate(config('cms.posts_per_page'));
        }
        return view('admin.news.index',compact('chaoSkies','searchText'));
    }
    public function searchByUser($userid)
    {
        $searchText=null;

        $chaoSkies=null;

        $chaoSkies = ChaoSky::where('delflag',0)
                            ->where('userid',$userid)
                            ->orderBy('stime', 'desc')
                            ->paginate(config('cms.posts_per_page'));

        return view('admin.news.index',compact('chaoSkies','searchText'));
    }

}
