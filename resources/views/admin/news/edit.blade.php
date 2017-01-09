@extends('admin.layout')

@section('styles')
    <link href="{{ URL::asset('assets/pickadate/themes/default.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/pickadate/themes/default.date.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/pickadate/themes/default.time.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/selectize/css/selectize.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/upload.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('cms.title') }} <small>» 编辑</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ config('cms.title') }}编辑窗口</h3>
                </div>
                <div class="panel-body">

                    @include('admin.partials.errors')
                    @include('admin.partials.success')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.news.update', $tipid) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        @include('admin.news._form')

                        @include('admin.news._modals')


                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="submit" class="btn btn-success btn-lg" name="action" value="finished">
                                        <i class="fa fa-floppy-o"></i>
                                            保存 - 完成
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-lg" name="action" value="continue">
                                        <i class="fa fa-floppy-o"></i>
                                            保存 - 上一条
                                    </button>
                                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modal-delete">
                                        <i class="fa fa-times-circle"></i>
                                        删除
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

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
                    <h4 class="modal-title">确认</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i>
                        是否确定删除此{{ config('cms.title') }}？
                    </p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.news.destroy', $tipid) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i> 确认
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="upload-mask">
    </div>
    <div class="panel panel-info upload-file">
        <div class="panel-heading">
            上传文件
            <span class="close pull-right">关闭</span>
        </div>
        <div class="panel-body">
            <div id="validation-errors"></div>
            <form method="POST" action="{{ url('admin/newsupload/uploadImgFile') }}" id="imgForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label>文件上传</label>
                    <span class="require">(*)</span>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="thumb" name="file" type="file"  required="required">
                    <input id="filetype"  type="hidden" name="filetype" value="">
                </div>
            </form>
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script src="{{ URL::asset('assets/pickadate/picker.js') }}"></script>
    <script src="{{ URL::asset('assets/pickadate/picker.date.js') }}"></script>
    <script src="{{ URL::asset('assets/pickadate/picker.time.js') }}"></script>
    <script src="{{ URL::asset('assets/selectize/selectize.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.form.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('assets/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('assets/ueditor/ueditor.all.min.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('assets/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
<script>

    try
        {if (editor) {editor.destroy();}}
    finally {
        var editor = new UE.ui.Editor();
        editor.ready(function() {
        editor.execCommand( 'fontfamily', '微软雅黑' );
        });
    editor.render("tipcontent");}

    $(function() {
        jQuery.extend( jQuery.fn.pickadate.defaults, {
            monthsFull: [ '一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月' ],
            monthsShort: [ '一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二' ],
            weekdaysFull: [ '星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六' ],
            weekdaysShort: [ '日', '一', '二', '三', '四', '五', '六' ],
            today: '今日',
            clear: '清除',
            close: '关闭',
            firstDay: 1,
            format: 'yyyy 年 mm 月 dd 日',
            formatSubmit: 'yyyy-mm-dd'
        });

        jQuery.extend( jQuery.fn.pickatime.defaults, {
            clear: '清除'
        });

        $("#publish_date").pickadate({
            format: "yyyy-mm-dd"
        });
        $("#publish_time").pickatime({
            format: "HH:i"
        });

        $("#vote_begin_date").pickadate({
            format: "yyyy-mm-dd"
        });
        $("#vote_begin_time").pickatime({
            format: "HH:i"
        });

        $("#vote_end_date").pickadate({
            format: "yyyy-mm-dd"
        });
        $("#vote_end_time").pickatime({
            format: "HH:i"
        });

        $('#btn_add_voteitem').on('click',function(){
            $('#voteitems').append(' <div class="voteitem form-group"> <input name="voteitemids[]" type="hidden" value="0"> <label class="control-label"> 选项 </label> <input class="form-control" name="vote_items[]" type="text"> <label class="control-label"> 票数 </label> <input class="form-control" name="votecounts[]" type="text" value="0"> <label class="control-label"> 缩略图 </label> <input type="text" class="form-control" name="itemimgs[]" > <div class="itemimg-upload btn btn-info btn-xs" title="上传"> 上传 </div> <label class="control-label"> 视频 </label> <input type="text" class="form-control" name="itemvideos[]" > <div class="itemvideo-upload btn btn-info btn-xs" title="上传"> 上传 </div> <button type="button" class="btn btn-xs btn-danger btn-remove-self"> <i class="fa fa-times-circle fa-lg"> </i> </button> </div> ');
        });

        $('#btn_empty_voteitem').on('click',function(){
           $('#voteitems').empty();
        });

        $('#btn_remove_voteitem').on('click',function(){
           $("#voteitems .voteitem:last").remove();
        });

        $('.form-group').delegate(".btn-remove-self","click",function(){
            $(this).parent().remove();
        });

        //上传图片相关

        $('.upload-mask').on('click',function(){
            $(this).hide();
            $('.upload-file').hide();
        });

        $('.upload-file .close').on('click',function(){
            $('.upload-mask').hide();
            $('.upload-file').hide();
        });


        $('.pic-upload').on('click',function(){
            $('.upload-mask').show();
            $('.upload-file').show();

            $('#filetype').attr('value','image');
        });

        $('.video-upload').on('click',function(){
            $('.upload-mask').show();
            $('.upload-file').show();

            $('#filetype').attr('value','video');
        });

        var itarget;

        $('#voteitems').on('click','.itemimg-upload',function(){
            $('.upload-mask').show();
            $('.upload-file').show();

            $('#filetype').attr('value','itemimage');
            itarget=$(this).prev();
        });

        $('#voteitems').on('click','.itemvideo-upload',function(){
            $('.upload-mask').show();
            $('.upload-file').show();

            $('#filetype').attr('value','itemvideo');
            itarget=$(this).prev();
        });


        //ajax 上传
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#imgForm input[name=file]').on('change', function(){
                //$('#upload-avatar').html('正在上传...');
                $('#imgForm').ajaxForm(options).submit();
            });
        });

        function showRequest() {
            $("#validation-errors").hide().empty();
            $("#output").css('display','none');
            return true;
        }

        function showResponse(response)  {
            if(!response.success)
            {
                var responseErrors = response.errors;

                $("#validation-errors").append('<div class="alert alert-error"><strong>'+ responseErrors +'</strong><div>');

                $("#validation-errors").show();
            } else {

                $('.upload-mask').hide();
                $('.upload-file').hide();
                if (response.filetype=='image'){
                    $("#tipimg1").val(response.src);
                }else if (response.filetype=='video'){
                    $("#tipvideo").val(response.src);
                }else if (response.filetype=='itemimage'){
                    itarget.val(response.src);
                }else if (response.filetype=='itemvideo'){
                    itarget.val(response.src);
                }

            }
        }

    });
</script>
@stop