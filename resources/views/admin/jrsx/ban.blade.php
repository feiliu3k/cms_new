@extends('admin.layout')
@section('styles')

    <link href="{{ URL::asset('assets/css/jrsx.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lightbox.css') }}" rel="stylesheet">

@stop
@section('content')
    <div class="container-fluid">
        @include('admin.partials.errors')
        @include('admin.partials.success')
        <div class="col-md-8 col-md-offset-1 topics-index main-col">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="pull-right list-inline remove-margin-bottom topic-filter">
                        <li>
                            <a href="{{ route('admin.jrsx.index') }}" class="selected">
                                <i class="glyphicon glyphicon-time"></i> 报料首页
                            </a>
                            <span class="divider"></span>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body remove-padding-horizontal main-body">
                    <table id="banlist-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>记录</th>
                            <th>时间</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($banes as $ban)
                        <tr>
                            <td data-order="{{ $ban->banid }}">{{ $ban->banid }}</td>
                            <td>{{ $ban->banrecord }}</td>
                            <td>{{ $ban->bantime }}</td>
                            <td>
                                <a href="{{ url('admin/jrsx/bandelete').'/'.$ban->banid }}" class="btn btn-xs btn-danger">
                                    <i class="fa fa-delete"></i> 删除
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                </div>

                <div class="panel-footer text-right">

                </div>
            </div>
        </div>
        <div class="col-md-2 side-bar">
            <div class="panel panel-default corner-radius">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">找找看</h3>
                </div>
                <div class="panel-body text-center">
                    <form method="GET" class="form-horizontal" action="{{ route('admin.jrsx.search') }}" >
                        <div class="form-group ">
                            <label class="sr-only" for="searchText">搜索的关键字</label>
                            <input type="text" class="form-control" id="searchText" name="searchText" placeholder="请输入要搜索的关键字">
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>搜索</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default corner-radius">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">功能栏</h3>
                </div>
                <div class="panel-body">
                    <ul class="list">
                        <li><a href="{{ route('admin.fav.index') }}">我的收藏</a></li>
                        <li><a href="{{ route('admin.remark.index') }}">我的备注</a></li>
                        @can('edit-banlist')
                        <li><a href="{{ route('admin.jrsx.banlist') }}">禁止列表</a></li>
                        @endcan
                        <li><a href="{{ route('admin.jrsx.index') }}">返回首页</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


@stop

@section('scripts')
    <script>
        $(function() {
            $("#banlist-table").DataTable({
            });
        });
    </script>
@stop