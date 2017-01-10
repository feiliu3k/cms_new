<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="tiptitle" class="col-md-2 control-label">
                标题
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="tiptitle" autofocus id="tiptitle" v-model="chaosky.tiptitle" >
            </div>
        </div>
        <div class="form-group">
            <label for="tipcontent" class="col-md-2 control-label">
                内容
            </label>
           <!--  <div class="col-md-10">
                 <script id="tipcontent" name="tipcontent" type="text/plain" style="width:100%;height:800px;">@{{{ chaosky.tipcontent }}}</script>
            </div> -->
<!--             <div class="col-md-10">
                <textarea id="tipcontent" v-model="chaosky.tipcontent" style="width:100%;height:800px;"></textarea>
            </div> -->

            <div class="col-md-10">
                <textarea v-model="chaosky.tipcontent" style="display:none"></textarea>
                <div id="editor" v-ueditor="chaosky.tipcontent" style="width:100%;height:800px;"></div>
            </div>


        </div>


    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="tipimg1" class="col-md-3 control-label">
                缩略图
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="tipimg1"  id="tipimg1"  v-model="chaosky.tipimg1" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-4 thumb-wrap">
                <div class="pic-upload btn btn-block btn-info btn-flat" title="点击上传">点击上传</div>
           </div>
        </div>

        <div class="form-group">
            <label for="tipvideo" class="col-md-3 control-label">
                视频
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="tipvideo"  id="tipvideo" v-model="chaosky.tipvideo" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-4 thumb-wrap">
                <div class="video-upload btn btn-block btn-info btn-flat" title="点击上传">点击上传</div>
            </div>
        </div>
        <div class="form-group">
            <label for="publish_date" class="col-md-3 control-label">
                发布日期
            </label>
            <div class="col-md-8">
                <input class="form-control" name="publish_date" id="publish_date" type="text" v-model="chaosky.publish_date" >
            </div>
        </div>
        <div class="form-group">
            <label for="publish_time" class="col-md-3 control-label">
                发布时间
            </label>
            <div class="col-md-8">
                <input class="form-control" name="publish_time" id="publish_time" type="text" v-model="chaosky.publish_time" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input  type="checkbox" name="toporder" v-model="chaosky.zanflag" >
                        点赞
                    </label>
                </div>
            </div>
        </div>
        @can('create-zan')
        <div class="form-group" v-if="chaosky.zanflag">
            <label for="zannum" class="col-md-3 control-label">
                点赞数
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="zannum" v-model="chaosky.zannum">
            </div>
        </div>
        <div class="form-group" v-show="chaosky.zanflag">
            <label for="zan_end_date" class="col-md-3 control-label">
                点赞结束日期
            </label>
            <div class="col-md-8">
                <input class="form-control" name="zan_end_date" id="zan_end_date" type="text" v-model="chaosky.zan_end_date" >
            </div>
        </div>
        @endcan
        <div class="form-group" v-show="chaosky.zanflag">
            <label for="zan_end_time" class="col-md-3 control-label">
                点赞结束时间
            </label>
            <div class="col-md-8">
                <input class="form-control" name="zan_end_time" id="zan_end_time" type="text" v-model="chaosky.zan_end_time" >
            </div>
        </div>
        @can('create-toporder')
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input  type="checkbox" name="toporder" v-model="chaosky.toporder" >
                        <span style="color:red"><b>置顶</b></span>
                    </label>
                </div>
            </div>
        </div>
        @endcan
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input  type="checkbox" name="draftflag" v-model="chaosky.draftflag" >
                        草稿
                    </label>
                </div>
            </div>
        </div>
        @can('create-comment')
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="commentflag" v-model="chaosky.commentflag">
                        打开评论
                    </label>
                 </div>
            </div>
        </div>
        @endcan
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    @can('edit-vote')
                        <button v-if="chaosky.voteflag" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-vote-create">
                        <i class="fa fa-upload"></i> 编辑投票功能
                        </button>
                    @endcan

                    @can('create-vote')
                        <button type="button" v-else class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-vote-create">
                        <i class="fa fa-upload"></i> 新建投票功能
                         </button >
                    @endcan
                </div>
            </div>
        </div>
        @can('create-readnum')
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <button v-if="chaosky.voteflag" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-input-create">
                        <i class="fa fa-upload"></i> 编辑用户元信息
                </button>
            </div>
        </div>
        @endcan
        @can('create-readnum')
        <div class="form-group">
            <label for="readnum" class="col-md-3 control-label">
                阅读数
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="readnum" autofocus id="readnum" v-model="chaosky.readnum">
            </div>
        </div>
        @endcan
        <input type="hidden" class="form-control" name="readnum" autofocus id="readnum" v-model="chaosky.readnum">
        <div class="form-group">
            <label for="proid" class="col-md-3 control-label">
                栏目
            </label>
            <div class="col-md-8">
                <select name="proid" id="proid" class="form-control" v-model="chaosky.proid">
                    <template v-for="chaopro in chaopros">
                        <option v-bind:value="chaopro.id" v-on:selected="{'selected':chaosky.proid==chaopro.id}">
                           @{{ chaopro.proname }}
                        </option>
                    </template>
                </select>
            </div>
        </div>
    </div>
</div>
