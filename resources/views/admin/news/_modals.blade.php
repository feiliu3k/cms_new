{{-- 新建投票功能 --}}

<div class="modal fade col-md-12"  id="modal-vote-create">
    <div class="modal-content">
        <div class="form-horizontal" id="voteCreateFrm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">投票功能</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        <input  type="checkbox" name="voteflag" value="1" @if ($voteflag==1) checked="checked" @endif >
                            投票
                    </div>
                </div>

                <div class="form-group">
                    <label for="votenum" class="col-md-2 control-label">
                        用户可选项目个数
                    </label>
                    <div class="col-md-6">
                        <input type="text" id="votenum" name="votenum" class="form-control" value={{ $votenum }}>
                    </div>
                </div>

                <div class="form-group">
                   <label for="vote_begin_date" class="col-md-2 control-label">
                        投票开始时间
                    </label>
                    <div class="form-inline">
                        <div class="col-md-10">
                            <input class="form-control" name="vote_begin_date" id="vote_begin_date" type="text" value="{{ $vote_begin_date }}">
                            <input class="form-control" name="vote_begin_time" id="vote_begin_time" type="text" value="{{ $vote_begin_time }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <label for="vote_begin_date" class="col-md-2 control-label">
                        投票开始时间
                    </label>
                    <div class="form-inline">
                        <div class="col-md-10">
                            <input class="form-control" name="vote_end_date" id="vote_end_date" type="text" value="{{ $vote_end_date }}">
                            <input class="form-control" name="vote_end_time" id="vote_end_time" type="text" value="{{ $vote_end_time }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        投票选项列表
                    </label>
                    <div class="col-md-10">
                        <div class="form-inline" id="voteitems">
                            @if ($voteItems)
                                @foreach ($voteItems as $voteItem)
                                <div class="voteitem form-group">
                                    <input name="voteitemids[]" type="hidden" value="{{ $voteItem->id }}">
                                    <label  class="control-label">
                                        选项
                                    </label>
                                    <input class="form-control" name="vote_items[]" type="text" value="{{ $voteItem->itemcontent }}">
                                    <label class="control-label">
                                        票数
                                    </label>
                                    <input class="form-control" name="votecounts[]" type="text" value="{{ $voteItem->votecount }}">
                                    <label class="control-label">
                                        缩略图
                                    </label>
                                    <input type="text" class="form-control" name="itemimgs[]" value="{{ $voteItem->itemimg }}">
                                    <div class="itemimg-upload btn btn-info btn-xs" title="点击上传">上传</div>
                                    <label class="control-label">
                                        视频
                                    </label>
                                    <input type="text" class="form-control" name="itemvideos[]" value="{{ $voteItem->itemvideo }}">
                                    <div class="itemvideo-upload btn btn-info btn-xs" title="点击上传">上传</div>
                                    <button type="button" class="btn btn-xs btn-danger btn-remove-self">
                                        <i class="fa fa-times-circle fa-lg"></i>
                                    </button>
                                </div>
                                @endforeach
                            @else
                            <div class="voteitem form-group">
                                <input name="voteitemids[]" type="hidden" value="0">
                                <label class="control-label">
                                    选项
                                </label>
                                <input class="form-control" name="vote_items[]" type="text">
                                <label class="control-label">
                                    票数
                                </label>
                                <input class="form-control" name="votecounts[]" type="text" value="0">
                                <label class="control-label">
                                    缩略图
                                </label>
                                <input type="text" class="form-control" name="itemimgs[]" >
                                <div class="itemimg-upload btn btn-info btn-xs" title="点击上传">上传</div>
                                <label class="control-label">
                                    视频
                                </label>
                                <input type="text" class="form-control" name="itemvideos[]" >
                                <div class="itemvideo-upload btn btn-info btn-xs" title="点击上传">上传</div>
                                <button type="button" class="btn btn-xs btn-danger btn-remove-self">
                                    <i class="fa fa-times-circle fa-lg"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_add_voteitem">
                    添加投票选项
                </button>
                <button type="button" class="btn btn-danger" id="btn_remove_voteitem">
                    删除投票选项
                </button>
                <button type="button" class="btn btn-warning" id="btn_empty_voteitem" >
                    清空投票选项
                </button>
                <button type="button" class="btn btn-primary" id="btn_Create_OK" data-dismiss="modal">
                    确认
                </button>
            </div>
        </div>
    </div>
</div>



{{-- 编辑投票功能 --}}