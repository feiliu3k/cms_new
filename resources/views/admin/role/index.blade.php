@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>角色 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.role.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建角色
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="roles-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>名称</th>
                            <th>标签</th>
                            <th>描述</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->label }}</td>
                            <td>{{ $role->description}}</td>
                            <td>
                                <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                                <a href="{{ url('admin/role/editPermission', $role->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 权限
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
            $("#roles-table").DataTable({
            });
        });
    </script>
@stop