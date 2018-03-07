@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('cms.dept') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.dept.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建{{ config('cms.dept') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="depts-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th class="hidden-md">名称</th>
                            <th class="hidden-md">序号</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($depts as $dept)
                        <tr>
                            <td>{{ $dept->id }}</td>
                            <td class="hidden-md">{{ $dept->depname }}</td>
                            <td class="hidden-sm">
                               {{ $dept->depid }}
                            </td>

                            <td>
                                <a href="{{ route('admin.dept.edit', $dept->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
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
            $("#depts-table").DataTable({
            });
        });
    </script>
@stop