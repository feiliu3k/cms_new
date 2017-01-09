@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>用户 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建用户
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="users-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th class="hidden-md">名称</th>
                            <th class="hidden-md">邮件</th>
                            <th>单位</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="hidden-md">{{ $user->name }}</td>
                            <td class="hidden-md">{{ $user->email }}</td>
                            <td class="hidden-md">{{ $user->chaoDep->depname }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                                <a href="{{ url('admin/user/editRole', $user->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 角色
                                </a>
                                <a href="{{ url('admin/user/editPro', $user->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 栏目
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {
            $("#users-table").DataTable({
            });
        });
    </script>
@stop