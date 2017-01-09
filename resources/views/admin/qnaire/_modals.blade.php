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
                        <input  type="checkbox" name="voteflag" v-model="chaosky.voteflag" >
                            投票
                    </div>
                </div>

                <div class="form-group">
                   <label for="vote_begin_date" class="col-md-2 control-label">
                        投票开始时间
                    </label>
                    <div class="form-inline">
                        <div class="col-md-10">
                            <input class="form-control" name="vote_begin_date" id="vote_begin_date" type="text" v-model="chaosky.vote_begin_date" >
                            <input class="form-control" name="vote_begin_time" id="vote_begin_time" type="text" v-model="chaosky.vote_begin_time" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <label for="vote_begin_date" class="col-md-2 control-label">
                        投票结束时间
                    </label>
                    <div class="form-inline">
                        <div class="col-md-10">
                            <input class="form-control" name="vote_end_date" id="vote_end_date" type="text" v-model="chaosky.vote_end_date" >
                            <input class="form-control" name="vote_end_time" id="vote_end_time" type="text" v-model="chaosky.vote_end_time" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        投票问题列表
                    </label>
                    <div class="form-group col-md-8">
                        <div class="form-inline" id="votetitles">
                            <ul class="list-group" v-for="votetitle in chaosky.vote_titles" style="margin-bottom: 0px ">
                                <li class="list-group-item list-group-item-success">
                                    <div class="votetitle" style="display:block;margin-bottom:10px">
                                        <input name="vtid" type="hidden" v-model="votetitle.vtid" >
                                        <label class="control-label">投票题目</label>
                                        <input class="form-control" name="votetitle" type="text" v-model="votetitle.votetitle" >
                                        <label class="control-label"> 用户可选择选项数量 </label>
                                        <input class="form-control" name="votenum" type="text" v-model="votetitle.votenum" >
                                        <label class="control-label">
                                            <input  type="checkbox" name="aflag" v-model="votetitle.aflag" > 正确答案
                                        </label>
                                        <button type="button" class="btn btn-xs btn-danger" v-on:click="deleteVoteTitle(votetitle)">  <i class="fa fa-times-circle fa-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-success" v-on:click="addVoteItem(votetitle)"> <i class="fa fa-plus-circle"></i> </button>
                                    </div>

                                    <ul class="list-group" style="margin-bottom: 0px" v-for="voteitem in votetitle.vote_items">
                                        <li class="list-group-item list-group-item-info">
                                            <div class="voteitem" >
                                                <input name="voteitemid" type="hidden" v-model="voteitem.id">
                                                <label class="control-label"> 投票选项 </label>
                                                <input class="form-control" name="itemcontent" type="text" v-model="voteitem.itemcontent" >
                                                <label class="control-label"> 票数 </label>
                                                <input class="form-control" name="votecount" type="text" v-model="voteitem.votecount" >
                                                <label class="control-label">
                                                <input  type="checkbox" name="rflag" v-model="voteitem.rflag"> 正确答案
                                                </label>
                                                <label class="control-label"> 缩略图 </label>
                                                <input type="text" class="form-control" name="itemimg"  v-model="voteitem.itemimg" >
                                                <div class="itemimg-upload btn btn-info btn-xs" title="上传"> 上传 </div>
                                                <label class="control-label"> 视频 </label>
                                                <input type="text" class="form-control" name="itemvideo"  v-model="voteitem.itemvideo" >
                                                <div class="itemvideo-upload btn btn-info btn-xs" title="上传"> 上传 </div>
                                                <button type="button" class="btn btn-xs btn-danger" v-on:click="deleteVoteItem(votetitle,voteitem)" >
                                                <i class="fa fa-times-circle fa-lg"> </i> </button>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_add_votetitle" v-on:click="addVoteTitle()">
                    添加题目
                </button>
                <button type="button" class="btn btn-danger" id="btn_remove_votetitle" v-on:click="deleteLastVoteTitle()">
                    删除题目
                </button>
                <button type="button" class="btn btn-warning" id="btn_empty_votetitle" v-on:click="emptyVoteTitle()">
                    清空题目
                </button>
                <button type="button" class="btn btn-primary" id="btn_Create_OK" data-dismiss="modal">
                    确认
                </button>
            </div>
        </div>
    </div>
</div>

{{-- 编辑用户元信息功能 --}}

<div class="modal fade col-md-12"  id="modal-input-create">
    <div class="modal-content">
        <div class="form-horizontal" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">编辑用户元信息功能</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-inline">
                        <ul class="list-group" >
                            <li class="list-group-item list-group-item-success" v-for="input_table in chaosky.input_tables">
                                <label for="vote_begin_date" class="col-md-2 control-label">
                                    元信息字段
                                </label>
                                <input class="form-control" type="hidden" v-model="input_table.id" >
                                <input class="form-control" type="text" placeholder="字段名称" v-model="input_table.inputname">
                                <input class="form-control" type="checkbox" v-model="input_table.nullflag">是否为空
                                <button type="button" class="btn btn-xs btn-danger" v-on:click="deleteInput(input_table)">  <i class="fa fa-times-circle fa-lg"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"  v-on:click="addInput()">
                    添加元信息
                </button>
                <button type="button" class="btn btn-danger"  v-on:click="deleteLastInput()">
                    删除元信息
                </button>
                <button type="button" class="btn btn-danger" v-on:click="emptyInput()">
                    清空元信息
                </button>
                <button type="button" class="btn btn-primary"  data-dismiss="modal">
                    确认
                </button>
            </div>
        </div>
    </div>
</div>