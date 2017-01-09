

    {{-- 报料收藏 --}}
    <div class="modal fade" id="modal-jrsx-fav">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('/admin/fav') }}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">收藏报料</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="jrsx_id" name="jrsx_id">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-lg"></i>
                            是否要收藏此报料?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary">
                            确认
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 取消报料收藏 --}}
    <div class="modal fade" id="modal-jrsx-cancelfav">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('/admin/fav/destory') }}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">取消收藏报料</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="jrsx_id" name="jrsx_id">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-lg"></i>
                            是否要取消收藏此报料?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary">
                            确认
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 删除报料 --}}
    <div class="modal fade" id="modal-jrsx-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('/admin/jrsx/destory') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">删除报料</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="jrsx_id" name="jrsx_id">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-lg"></i>
                            是否要删除此报料?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-danger">
                            确认
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 报料备注 --}}
    <div class="modal fade" id="modal-jrsx-remark">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('/admin/remark') }}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">备注报料</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="jrsx_id" name="jrsx_id">
                        <div class="form-group">
                        <label for="remark" class="col-sm-3 control-label">
                            备注
                        </label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="9" name="remark" id="remark" autofocus></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary">
                            确认
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 修改报料备注 --}}
    <div class="modal fade" id="modal-jrsx-modifyremark">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('/admin/remark/update') }}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">备注报料</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="jrsxremarkid" name="jrsxremarkid">
                        <div class="form-group">
                        <label for="remark" class="col-sm-3 control-label">
                            备注
                        </label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="9" name="remark" id="remark" autofocus></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary">
                            确认
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 禁止 --}}
    <div class="modal fade" id="modal-jrsx-ban">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('/admin/jrsx/ban') }}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">禁止此用户报料</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="banrecord" name="banrecord">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-lg"></i>
                            是否要禁止此用户报料?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary">
                            确认
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
