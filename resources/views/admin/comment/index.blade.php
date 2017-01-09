@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-6">
            <h3>评论 <small>» 列表</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-body">
            <form method="GET" action="{{ route('admin.comment.search') }}" class="form-inline">
                <div class="form-group-lg col-md-offset-3 col-md-4">
                    <label class="sr-only" for="searchText">搜索的关键字</label>
                    <input type="text" class="form-control" style="width:100%" id="searchText" name="searchText" placeholder="请输入要搜索的关键字" value={{ $searchText }}>
                </div>
                <div class="form-group-lg col-md-2">
                    <button type="submit" class="btn btn-success form-control" ><i class="fa fa-search"></i> 搜索</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            @include('admin.partials.errors')
            @include('admin.partials.success')

            <table id="comments-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>发表时间</th>
                        <th>关联新闻</th>
                        <th>评论内容</th>
                        <th>ip地址</th>
                        <th>审核标志</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($chaoComments as $chaoComment)
                    <tr>
                        <td data-order="{{ $chaoComment->ctime->timestamp }}">
                            {{ $chaoComment->ctime->format('Y-m-d H:i:s') }}
                        </td>
                        <td>{{ $chaoComment->chaoSky->tiptitle }}</td>
                        <td>{{ $chaoComment->comment }}</td>
                        <td>{{ $chaoComment->userip }}</td>
                        <td>{{ $chaoComment->verifyflag }}</td>

                        <td>
                            <a href="{{ route('admin.comment.edit', $chaoComment->cid) }}" class="btn btn-xs btn-info">
                                <i class="fa fa-edit"></i> 编辑
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pull-right">
        @if ($searchText)
            {!! $chaoComments->appends(['searchText' => $searchText])->render() !!}
        @else
            {!! $chaoComments->render() !!}
        @endif
    </div>
</div>
@stop

@section('scripts')
<script>
    // $(function() {
    //     $("#comments-table").DataTable({
    //         order: [[0, "desc"]]
    //     });
    // });
</script>
@stop