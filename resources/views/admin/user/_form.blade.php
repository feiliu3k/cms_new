<div class="form-group">
    <label for="name" class="col-md-3 control-label">
        名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-md-3 control-label">
        电子邮件
    </label>
    <div class="col-md-8">
        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
    </div>
</div>

<div class="form-group">
    <label for="proid" class="col-md-3 control-label">
        单位
    </label>
    <div class="col-md-8">
        <select name="dept_id" id="dept_id" class="form-control" >
        @foreach ($depts as $dept)
            @if ($user->dept_id==$dept->id)
            <option value="{{ $dept->id }} " selected="selected">
                {{ $dept->depname }}
            </option>
            @else
            <option value="{{ $dept->id }} ">
                {{ $dept->depname }}
            </option>
            @endif
        @endforeach
        </select>
    </div>
</div>
