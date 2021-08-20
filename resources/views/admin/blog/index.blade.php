@extends('admin.layouts.app')
@section('content')
@push('styles')
    <style>
    .main-left{margin-left: 20px;}
    </style>
    @if(lang() == "ar")
    <style>
        .main-container{
            text-align: right !important;
            direction: rtl !important;
        }
        .main-left{margin-right: 20px;}
        .dropdown-rtl{direction: rtl;}
        .dropdown-item{text-align: right;padding-right: 45px!important;padding-left: 15px !important;}
        .main_i{right: 15px;}
    </style>
    @endif
@endpush
<div class="main-container mt-5">
		<div class="pd-ltr-20 height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>{{$title}}</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{aurl('home')}}">{{ trans('web.Home') }}</a></li>
									<li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
								</ol>
							</nav>
						</div>
                        @include('admin.includes.messages')
					</div>
				</div>
				<div class="blog-wrap">
					<div class="container pd-0">
						<div class="row">
							<div class="col-md-8 col-sm-12">
								<div class="blog-list">
									<ul>
                                    @if($blogs)
                                        @foreach ($blogs as $blog)
										    <li>
											<div class="row no-gutters">
												<div class="col-lg-4 col-md-12 col-sm-12">
													<div class="blog-img">
                                                        <img src="{{$blog->image->url}}" alt="" class="bg_img">
													</div>
												</div>
												<div class="col-lg-8 col-md-12 col-sm-12">
													<div class="blog-caption">
														<h4><a href="{{aurl('blog/show/'.$blog->id)}}">{{ \Illuminate\Support\Str::limit($blog->name, 50, '...') }}</a></h4>
                                                        <h5 style="color: #5d6872;"><i class="icon-copy fa fa-clock-o" aria-hidden="true"></i>  {{$blog->time_ago}}</h5>
                                                        <p style="color: #919ea8;"> {!! \Illuminate\Support\Str::limit($blog->text, 150,'...') !!} </p>
                                                        <div class="row">
                                                            <a href="{{aurl('blog/show/'.$blog->id)}}" class="btn btn-outline-primary">{{trans('web.Read More')}}</a>
                                                            <div class="dropdown text-right main-left">
                                                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                                    {{trans('web.Settings')}}
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                    <a class="dropdown-item view_ads" href="{{aurl('blog/edit/'.$blog->id)}}"
                                                                    ><i class="main_i dw dw-eye"></i>{{ trans('web.Edit') }}</a>
                                                                    @if ($blog->status == 1)
                                                                        <button class="dropdown-item not_activate_ads" data-id="{{ $blog->id }}"
                                                                        ><i class="main_i dw dw-edit2"></i>{{ trans('web.Not Activate') }}</button>
                                                                    @else
                                                                        <button class="dropdown-item activate_ads" data-id="{{ $blog->id }}"
                                                                        ><i class="main_i dw dw-edit2"></i>{{ trans('web.Activate') }}</button>
                                                                    @endif
                                                                    @if ($blog->allow_comment == 0)
                                                                    <button class="dropdown-item allow_comment" data-id="{{ $blog->id }}"
                                                                    ><i class="main_i icon-copy dw dw-chat-1"></i>{{ trans('web.Allow Comments') }}</button>
                                                                    @endif
                                                                    <button class="dropdown-item delete_ads" data-id="{{ $blog->id }}"
                                                                    ><i class="main_i dw dw-delete-3"></i>{{ trans('web.Delete') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
													</div>
												</div>
											</div>
										</li>
                                        @endforeach
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            {{ trans('web.There Is No Blogs Yet.') }}
                                        </div>
                                    @endif
									</ul>
								</div>
								<div class="blog-pagination">
									<div class="blog-pagination mb-30">
                                        {{ $blogs->links('admin.pagination.index') }}
                                    </div>
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="card-box mb-30">
									<h5 class="pd-20 h5 mb-0">{{trans('web.Latest Post')}}</h5>
									<div class="latest-post">
										<ul>
                                            @foreach ($leatest_blogs as $leatest_blog)
                                                <li>
                                                    <h4><a href="{{aurl('blog/show/'.$leatest_blog->id)}}">{{ \Illuminate\Support\Str::limit($leatest_blog->name, 50, '...') }}</a></h4>
                                                    <span><i class="icon-copy fa fa-clock-o" aria-hidden="true"></i>  {{$leatest_blog->time_ago}}</span>
                                                </li>
                                            @endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="modal fade" id="allow_commentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to allow comments for this article ?')}}</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{aurl('blog/allow_comment')}}" method="POST">
                            @csrf
                            <input type="hidden" name="ads_id" id="ads_id_2">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    {{ trans('web.NO') }}
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                                     {{ trans('web.YES') }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to activate this article ?')}}</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{aurl('blog/activate')}}" method="POST">
                            @csrf
                            <input type="hidden" name="ads_id" id="ads_id_3">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    {{ trans('web.NO') }}
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                                    {{ trans('web.YES') }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to delete This article ?')}}</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{aurl('blog/delete_ads')}}" method="POST">
                            @csrf
                            <input type="hidden" name="ads_id" id="ads_id">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    {{ trans('web.NO') }}
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-danger border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></button>
                                    {{ trans('web.YES') }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="not_activate_adsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to disactivate this article ?')}}</h4>
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form action="{{aurl('blog/disactivate_ads')}}" method="POST">
                            @csrf
                            <input type="hidden" name="ads_id" id="ads_id_4">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    {{ trans('web.NO') }}
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                                    {{ trans('web.YES') }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
        $(document).ready(function() {
            $(".activate_ads").click(function() {
                var id = $(this).attr('data-id');
                $("#ads_id_3").val(id);
                $("#activateModal").modal('toggle');
            });
            $(".not_activate_ads").click(function() {
                var id = $(this).attr('data-id');
                $("#ads_id_4").val(id);
                $("#not_activate_adsModal").modal('toggle');
            });
            $(".allow_comment").click(function() {
                var id = $(this).attr('data-id');
                $("#ads_id_2").val(id);
                $("#allow_commentModal").modal('toggle');
            });
            $(".delete_ads").click(function() {
                var id = $(this).attr('data-id');
                $("#ads_id").val(id);
                $("#deleteModal").modal('toggle');
            });
        });
    </script>
    @endpush

    @endsection
