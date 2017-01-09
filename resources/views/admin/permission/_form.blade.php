<div class="form-group">
    <label for="name" class="col-md-3 control-label">
        名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="name" id="name" value="{{ $permission->name }}">
    </div>
</div>
<div class="form-group">
    <label for="label" class="col-md-3 control-label">
        标签
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="label" id="label" value="{{ $permission->label }}">
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-md-3 control-label">
        描述
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="description" id="description" value="{{ $permission->description }}">
    </div>
</div>