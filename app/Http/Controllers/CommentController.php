<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ChaoComment;
use Input, Response;

class CommentController extends Controller
{



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify()
    {
        $input = Input::all();
        $chaoComment = ChaoComment::findOrFail($input['cid']);

        $chaoComment->verifyflag = (($chaoComment->verifyflag)==0) ? 1 : 0;
        $tipid=$chaoComment->tipid;

        $chaoComment->save();

        $response = array(
            'status' => 0,
            'verifyflag'=>$chaoComment->verifyflag,
            'msg' => '审核修改成功！',
        );

        return Response::json( $response );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $input = Input::all();
        $chaoComment = ChaoComment::findOrFail($input['cid']);
        $tipid=$chaoComment->tipid;
        $chaoComment->delflag=1;

        $chaoComment->save();

        $response = array(
            'status' => 'success',
            'msg' => '评论删除成功！',
        );

        return Response::json( $response );
    }
}
