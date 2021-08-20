@if ($errors->any())
<div class="col-md-12">
    <div class="alert alert-danger" role="alert">
        <h4 class="text-danger"><strong>{{ trans('web.sorry_some_errors') }}!</strong></h4>
        @foreach($errors->all() as $error)
        <p>* {{ $error }}</p>
        @endforeach
    </div>
</div>
@endif

<div class="col-md-12">
    @if(session()->has('success'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ trans('web.success') }}!</strong> {{ trans('web.'.session('success')) }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    @endif
    @if(session()->has('faild'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ trans('web.faild') }}!</strong> {{ trans('web.'.session('faild')) }}.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    @endif
</div>
