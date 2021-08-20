@if ($errors->any())
<div class="col-md-12">
    <div class="toast mt-3" data-autohide="false">
        <div class="toast-header ">
            <strong class="mr-auto text-danger">{{ trans('web.faild') }}</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body p-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<div class="col-md-12">
    @if(session()->has('success'))
        <div class="toast mt-3" data-autohide="false">
            <div class="toast-header">
                <strong class="mr-auto text-primary">{{ trans('web.success') }}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body p-4">
                {{ trans('web.'.session('success')) }}
            </div>
        </div>
    @endif
    @if(session()->has('faild'))
    <div class="toast mt-3" data-autohide="false">
        <div class="toast-header">
            <strong class="mr-auto text-danger">{{ trans('web.faild') }}</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body p-4">
            {{ trans('web.'.session('faild')) }}
        </div>
    </div>
    @endif
</div>
