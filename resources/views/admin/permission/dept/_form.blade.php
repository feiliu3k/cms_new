
<div class="form-group">
    <label for="deptname" class="col-md-3 control-label">
        {{ config('cms.dept') }}名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="depname" name="depname" value="{{ $depname }}">
    </div>
</div>

<div class="form-group">
    <label for="deptid" class="col-md-3 control-label">
        {{ config('cms.dept') }}序号
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="depid" name="depid" value="{{ $depid }}">
    </div>
</div>

