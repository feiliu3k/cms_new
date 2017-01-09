@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>权限 <small>» 编辑</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑权限窗口</h3>
                </div>
                <div class="panel-body">

                    @include('admin.partials.errors')
                    @include('admin.partials.success')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.permission.update', $permission->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $permission->id }}">


                        @include('admin.permission._form')

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-save"></i>
                                    保存
                                </button>
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal-delete">
                                    <i class="fa fa-times-circle"></i>
                                    删除
                                </button>
                                <a type="button" class="btn btn-primary btn-md" href="{{ route('admin.permission.index') }}">
                                    <i class="fa fa-reply"></i>
                                    返回
                                </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- 确认删除 --}}
<div class="modal fade" id="modal-delete" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">请确认修改</h4>
            </div>
            <div class="modal-body">
                <p class="lead">
                    <i class="fa fa-question-circle fa-lg"></i>
                    是否真的需要删除此权限？
                </p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.permission.destroy', $permission->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times-circle"></i> 确认
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop