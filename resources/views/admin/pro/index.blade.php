@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('cms.pro') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.pro.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建{{ config('cms.pro') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="pros-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="hidden-md">编号</th>
                            <th >名称</th>
                            <th >报料</th>
                            <th >单位</th>
                            <th >缩略图</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($pros as $pro)
                        <tr>
                            <td>{{ $pro->proid }}</td>
                            <td class="hidden-md">{{ $pro->proname }}</td>
                            <td class="hidden-sm">
                                @if ($pro->rebellion==2)
                                    有报料功能
                                @else
                                    无报料功能
                                @endif
                            </td>
                            <td class="hidden-md">{{ $pro->chaoDep->depname }}</td>
                            <td class="hidden-md">{{ $pro->proimage }}</td>
                            <td>
                                <a href="{{ route('admin.pro.edit', $pro->id) }}" class="btn btn-xs btn-info">
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
            $("#pros-table").DataTable({
            });
        });
    </script>
@stop