<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <div>
                <span class="col-md-offset-2 col-md-4">
                    用户IP：{{$chaoComment->userip}}
                </span>
                <span class="col-md-6">
                    发布日期：{{ $chaoComment->ctime->format('Y-m-d') }}
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">
                评论新闻
            </label>
            <div class="col-md-10 ">
                <span class="form-control" >
                    {{ $chaoComment->chaosky->tiptitle }}
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="comment" class="col-md-2 control-label">
                评论内容
            </label>
            <div class="col-md-10">
                <textarea class="form-control" name="comment" rows=10 autofocus id="comment">
                    {{ $chaoComment->comment }}
                </textarea>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                        <input type="checkbox" name="verifyflag" value=1 @if ($chaoComment->verifyflag==1) checked="checked" @endif>
                        审核

                 </div>
            </div>
        </div>
    </div>
</div>
