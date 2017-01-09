@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>用户 <small>» 栏目编辑</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">用户栏目窗口</h3>
                </div>
                <div class="panel-body">

                    @include('admin.partials.errors')
                    @include('admin.partials.success')

                    <form class="form-horizontal" pro="form" method="POST" action="{{ url('admin/user/updatePro', $user->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <table id="pros-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="hidden-md"></th>
                                <th class="hidden-md">编号</th>
                                <th>名称</th>
                                <th>报料</th>
                                <th>缩略图</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($pros as $pro)
                                <tr>
                                    <td>
                                        @if(in_array($pro['id'],array_values($userpros)))
                                            <input type="checkbox" name="pros[]" value="{{ $pro->id }}" checked />
                                        @else
                                            <input type="checkbox" name="pros[]" value="{{ $pro->id }}" />
                                        @endif
                                    </td>
                                    <td>{{ $pro->proid }}</td>
                                    <td>{{ $pro->proname }}</td>
                                    <td class="hidden-sm">
                                        @if ($pro->rebellion==2)
                                            有报料功能
                                        @else
                                            无报料功能
                                        @endif
                                    </td>
                            <td class="hidden-md">{{ $pro->proimage }}</td>
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
    //     $("#pros-table").DataTable({
    //         order: [[0, "desc"]]
    //     });
    // });
</script>
@stop