@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>用户 <small>» 角色编辑</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">用户角色窗口</h3>
                </div>
                <div class="panel-body">

                    @include('admin.partials.errors')
                    @include('admin.partials.success')

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/user/updateRole', $user->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <table id="roles-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>名称</th>
                                <th>标签</th>
                                <th>描述</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        @if(in_array($role['id'],array_values($userRoles)))
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" checked />
                                        @else
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" />
                                        @endif
                                    </td>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->label }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-save"></i>
                                    保存
                                </button>
                                <a type="button" class="btn btn-primary btn-md" href="{{ route('admin.user.index') }}">
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


@stop

@section('scripts')
<script>
    // $(function() {
    //     $("#roles-table").DataTable({
    //         order: [[0, "desc"]]
    //     });
    // });
</script>
@stop