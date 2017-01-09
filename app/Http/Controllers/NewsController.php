<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\ChaoSky;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index()
    {
        $posts = ChaoSky::where('stime', '<=', Carbon::now())
                ->where('delflag',0)
                ->orderBy('stime', 'desc')
                ->paginate(config('cms.posts_per_page'));

        return view('news.index', compact('posts'));
    }

    public function show($id)
    {
        $post = ChaoSky::where('tipid',$id)->where('delflag',0)->first();

        return view('news.news')->withPost($post);
    }
}
