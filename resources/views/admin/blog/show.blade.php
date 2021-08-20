@extends('admin.layouts.app')
@section('content')
@push('styles')
    <style>
        strong{color: rgb(174 171 171);}
        a{text-decoration: none}
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
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row mb-2">
						<div class="col-md-12 col-sm-12">
							<div class="title">
                                <h4>{{$title}}</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{aurl('dashboard')}}">{{ trans('web.Home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
								</ol>
							</nav>
						</div>
					</div>
                    @include('admin.includes.messages')
				</div>
				<div class="blog-wrap">
					<div class="container pd-0">
						<div class="row">
							<div class="col-md-8 col-sm-12">
								<div class="blog-detail card-box overflow-hidden mb-30">
                                    @foreach ($images as$image )
                                       <div class="blog-img">
										<img src="{{$image->url}}" alt="">
									</div>
                                    @endforeach
									<div class="blog-caption">
										<h4 class="mb-10">{{$blog->name}}</p></h4>
                                        <span><i class="icon-copy fa fa-clock-o" aria-hidden="true"></i> {{$blog->time_ago}}</span>
										<p style="color: #83817e">{!!$blog->text!!}</p>
									</div>
								</div>
                                @if ($comments->count() > 0)
                                    <div class="mb-30">
                                        <div class="card-box">
                                            <div class="pd-20">
                                                <h4 class="text-blue h4">{{trans('web.Allow Comments')}}</h4>
                                            </div>
                                            <div class="pb-20 container">
                                                <div class="table-responsive">
                                                    <table class="data-table table stripe hover nowrap" id="datatableid">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-plus datatable-nosort">{{trans('web.Name')}}</th>
                                                                <th>{{trans('web.Email')}}</th>
                                                                <th>{{trans('web.Comment')}}</th>
                                                                <th>{{trans('web.Created at')}}</th>
                                                                <th class="datatable-nosort">{{trans('web.Action')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($comments as $comment)
                                                                <tr>
                                                                    <td class="table-plus">{{$comment->user? $comment->user->name : $comment->user_name}}</td>
                                                                    <td>{{$comment->user? $comment->user->email : $comment->email}}</td>
                                                                    <td>{{\Illuminate\Support\Str::limit($comment->comment, 50, '...')}}</td>
                                                                    <td>{{$comment->time_ago}}</td>
                                                                    <td>
                                                                        <div class="dropdown main-left">
                                                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                                                <i class="dw dw-more"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                                <button class="dropdown-item view_ads" data-comment="{{ $comment->comment }}"
                                                                                ><i class="main_i dw dw-eye"></i>{{trans('web.View')}}</button>
                                                                                @if ($comment->status == 1)
                                                                                    <button class="dropdown-item activate_ads" data-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}"
                                                                                    ><i class="main_i dw dw-edit2"></i>{{trans('web.Not Activate')}}</button>
                                                                                @endif
                                                                                <button class="dropdown-item delete_ads" data-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}"
                                                                                ><i class="main_i dw dw-delete-3"></i>{{trans('web.Delete')}}</button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">{{trans('web.Your Comment')}}</h3>
                <div class="mb-30 text-center"><i class="fa fa-comments-o" style="font-size: 50px;color: #f57200;"></i></div>
                <p id="ads_comment"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('web.Done')}}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to disactivate this comment?')}}</h4>
                <p id="ads_comment_2"></p>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{aurl('blog/disactivate')}}" method="POST">
                        @csrf
                        <input type="hidden" name="comment_id" id="ads_id_2">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                {{trans('web.NO')}}
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn" ><i class="fa fa-check"></i></button>
                                {{trans('web.YES')}}
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
                <h4 class="padding-top-30 mb-30 weight-500">{{trans('web.Are you sure you want to delete This comment?')}}</h4>
                <p id="ads_comment_3"></p>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <form action="{{aurl('blog/delete')}}" method="POST">
                        @csrf
                        <input type="hidden" name="comment_id" id="ads_id_3">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                {{trans('web.NO')}}
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-danger border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></button>
                                {{trans('web.YES')}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatableid').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            }
        });
    } );
</script>
<script>
    $(document).ready(function() {
        $(".view_ads").click(function() {
            var comment = $(this).attr('data-comment');
            $("#ads_comment").text(comment);
            $("#viewModal").modal('toggle');
        });
        $(".activate_ads").click(function() {
            var id = $(this).attr('data-id');
            var comment = $(this).attr('data-comment');
            $("#ads_id_2").val(id);
            $("#ads_comment_2").text(comment);
            $("#activateModal").modal('toggle');
        });
        $(".delete_ads").click(function() {
            var id = $(this).attr('data-id');
            var comment = $(this).attr('data-comment');
            $("#ads_id_3").val(id);
            $("#ads_comment_3").text(comment);
            $("#deleteModal").modal('toggle');
        });
    });
</script>
@endpush
@endsection
