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
                    <ul class="list-group row topic-list">
                    @if (count($jrsxRemarks)>0)
                        @foreach ($jrsxRemarks as $jrsxRemark)
                            $jrsx=$jrsxRemark->jrsx;
                            <li class="list-group-item media 1" style="margin-top: 0px;">
                                <div class="pull-left avatar">
                                    <a href="#">
                                        <i class="glyphicon glyphicon-thumbs-up"> </i>
                                        @if (($jrsx->f1)==1)
                                            报料
                                        @elseif (($jrsx->f1)==2)
                                            随手拍
                                        @elseif (($jrsx->f1)==3)
                                            送祝福
                                        @else
                                            其他
                                        @endif
                                    </a>
                                    <a href="{{ route('admin.jrsx.searchbypro', {$jrsx->chaoPro->proid) }}" >
                                        ({{$jrsx->chaoPro->proname}})
                                    </a>                                    
                                    ({{$jrsx->chaoPro->chaoDep->depname}})
                                </div>
                                <div class="infos">
                                    <div class="media-heading">
                                        <a href="{{ route('admin.jrsx.show', $jrsx->id) }}" >
                                            {{ $jrsx->comments }}
                                        </a>
                                    </div>
                                    <div class="add-margin-bottom">
                                        @if (count($jrsx->pic)>0)
                                            @foreach ($jrsx->pic as $img)
                                                @if (!containsDescenders($img))
                                                <img class="js-lightbox"
                                                    data-role="lightbox"
                                                    data-source="{{ $img }}"
                                                    src="{{ $img }}"
                                                    data-group="{{ $jrsx->id }}"
                                                    data-id="{{ $img }}"
                                                    data-caption="{{ $jrsx->username }}"
                                                    data-desc="{{ $jrsx->comments }}"
                                                    alt="{{ $img }}"
                                                    width="100px" height="100px" />
                                                @else
                                                    <img class="js-videobox"
                                                    data-role="videobox"
                                                    data-source="{{ $img }}"
                                                    src="{{ URL::asset('img/play.png') }}"
                                                    width="100px" height="100px" />
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>


                                    <div class="add-margin-bottom">
                                    <span class="username">姓名：{{ $jrsx->username }}</span>
                                        <span> • </span>
                                        <span class="dh">手机号码：{{ $jrsx->dh }}</span>
                                        <span> • </span>
                                        <span class="postdate">发表时间：{{ $jrsx->postdate }}</span>
                                    </div>



                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-jrsx-remark" data-jrsxid="{{ $jrsx->id }}">
                                            <i class="fa fa-plus-circle"></i> 备注
                                        </button>

                                        <button type="button" class="btn btn-warning btn-md" data-toggle="modal"  data-target="#modal-jrsx-ban" data-jrsxid="{{ $jrsx->id }}">
                                            <i class="fa fa-times-circle"></i> 禁止
                                        </button>

                                        <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal-jrsx-delete" data-jrsxid="{{ $jrsx->id }}">
                                            <i class="fa fa-times-circle"></i> 删除
                                        </button>
                                        @if (Auth::user()->jrsxes->where('id',$jrsx->id)->count()>0)
                                            <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modal-jrsx-cancelfav" data-jrsxid="{{ $jrsx->id }}">
                                                <i class="fa fa-plus-circle"></i> 取消收藏
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#modal-jrsx-fav" data-jrsxid="{{ $jrsx->id }}">
                                                <i class="fa fa-plus-circle"></i> 收藏
                                            </button>
                                        @endif
                                    </div>

                                </div>
                            </li>
                        @endforeach
                    @endif
                    </ul>
                </div>

                <div class="panel-footer text-right">
                    @if (count($jrsxRemarks)>0)
                        @if ($searchText)
                            {!! $jrsxRemarks->appends(['searchText' => $searchText])->render() !!}
                        @else
                            {!! $jrsxRemarks->render() !!}
                        @endif
                    @endif
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
                        <li><a href="{{ route('admin.jrsx.index') }}">返回首页</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('admin.jrsx._modals')

@stop

@section('scripts')
<script src="{{ URL::asset('assets/js/lightbox.js') }}"></script>
<script src="{{ URL::asset('assets/js/videobox.js') }}"></script>
<script>

    $(function() {

        var lightbox = new LightBox();
        var videobox = new VideoBox();

        $('#modal-jrsx-fav').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var jrsxid = button.data('jrsxid'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-body input').val(jrsxid);
        });

        $('#modal-jrsx-cancelfav').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var jrsxid = button.data('jrsxid'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-body input').val(jrsxid);
        });

        $('#modal-jrsx-delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var jrsxid = button.data('jrsxid');
            var modal = $(this);
            modal.find('.modal-body input').val(jrsxid);
        });

        $('#modal-jrsx-ban').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var jrsxid = button.data('jrsxid');
            var modal = $(this);
            modal.find('.modal-body input').val(jrsxid);
        });

        $('#modal-jrsx-remark').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var jrsxid = button.data('jrsxid');
            var modal = $(this);
            modal.find('.modal-body input').val(jrsxid);
        });

    });

</script>
@stop