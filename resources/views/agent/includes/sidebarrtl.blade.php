<div class="right-sidebar">
    <div class="sidebar-title">
        <h3 class="weight-600 font-16 text-blue">
            {{ trans('web.Layout Settings') }}
            <span class="btn-block font-weight-400 font-12">{{ trans('web.User Interface Settings') }}</span>
        </h3>
        <div class="close-sidebar" data-toggle="right-sidebar-close">
            <i class="icon-copy ion-close-round"></i>
        </div>
    </div>
    <div class="right-sidebar-body customscroll">
        <div class="right-sidebar-body-content">
            <h4 class="weight-600 font-18 pb-10">{{ trans('web.Language') }}</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="{{ gurl('language/en') }}" class="btn btn-outline-primary  {{lang() == "er" ? 'active' : ''}} ">{{ trans('web.English') }}</a>
                <a href="{{ gurl('language/ar') }}" class="btn btn-outline-primary  {{lang() == "ar" ? 'active' : ''}}">{{ trans('web.Arabic') }}</a>
            </div>
            <h4 class="weight-600 font-18 pb-10">{{ trans('web.Header Background') }}</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">{{ trans('web.White') }}</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">{{ trans('web.Dark') }}</a>
            </div>
            <h4 class="weight-600 font-18 pb-10">{{ trans('web.Sidebar Background') }}</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">{{ trans('web.White') }}</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">{{ trans('web.Dark') }}</a>
            </div>
        </div>
    </div>
</div>
