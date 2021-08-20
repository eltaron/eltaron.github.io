<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Deelmy</title>
</head>
<body>
	<div>
		<div>
			<div>
				{{-- <div><img src="{{ URL::asset(asset('admin')."/vendors/images/logo.png") }}"></div> --}}
				<h1>{{$data['title']}}</h1>
				<p>{{$data['body']}}</p>
				<div >
					<a href="{{$data['link']}}" >{{$data['title']}}</a>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
</body>
</html>
