@extends('admin.layout')

@section('styles')
    <style>
        a {
            text-decoration: none;
        }


        a,  a:focus,  a:hover {
            color: #555;
        }


        .badge-reply-count {
            background-color: #8BAFCE;
        }
    </style>
@stop

@section('content')
        <div class="container">
            <h1>{{ config('cms.title') }}</h1>
            <h5>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h5>
            <hr>
            <div class="panel panel-default">
            <div class="panel-body" style="padding: 0;">
            <ul class="list-group" style="margin-bottom: 0;">
            @foreach ($posts as $post)
                <li class="list-group-item">
                @if (Auth::check())
                    @can('list-readnum')
                        <span class="badge badge-reply-count">{{ $post->readnum }}</span>
                    @endcan
                @endif
                    <a href="{{ url('news',[$post->tipid]) }}" target="_blank">{{ $post->tiptitle }}</a>
                    <em>({{ $post->stime }})</em>
                </li>
            @endforeach
            </ul>
            </div>
            </div>
            {!! $posts->render() !!}
        </div>
@stop