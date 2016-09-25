@extends('layouts.mobile')

@section('content')
<style>
body {padding:15px}
table th, table td {padding:5px}
</style>
<table width="100%" border="1">
	<thead>
		<th>上传时间</th>
		<th>作者</th>
		<th>作品名</th>
		<th>联系电话</th>
		<th>照片故事</th>
		<th></th>
	</thead>
	<tbody>
		@foreach($photos as $v)
		<tr>
			<td>{{$v->created_at}}</td>
			<td>{{$v->author}}</td>
			<td>{{$v->title}}</td>
			<td>{{$v->mobile}}</td>			
			<td>{{$v->story}}</td>
			<td><a href="{{asset($v->file_path)}}">下载</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection
