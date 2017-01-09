@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>出错了!</strong>
        您输入的数据可能有错，请联系管理员！<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif