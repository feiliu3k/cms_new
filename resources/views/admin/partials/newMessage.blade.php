@if (Session::has('newMessage'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>
            <i class="fa fa-check-circle fa-lg fa-fw"></i> 警告
        </strong>
        {{ Session::get('newMessage') }}
    </div>
@endif