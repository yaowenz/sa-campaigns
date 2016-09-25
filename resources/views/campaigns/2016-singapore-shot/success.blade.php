@extends('layouts.mobile')

@section('content')
<style>
@import url('{{asset('campaigns/2016-singapore-shot/main.css')}}')
</style>

<img class="share hide" style="position:absolute;top:15px;right:15px" src="{{asset('campaigns/2016-singapore-shot/i/share-btn.png')}}" width="30%" />

<div style="position:absolute;top:25%;color:white;width:100%" class="success animated fadeIn">
	<div style="text-align: center;font-size:50px;font-weight:bold">上传成功!</div>
	<img src="{{asset('campaigns/2016-singapore-shot/i/rules.png')}}" width="80%" style="margin-top:30px;margin-left:10%;margin-right:10%">
</div>
<script>
$(function () {
	setTimeout(function() {
		$('.share').removeClass('hide');
		$('.share').addClass('animated fadeInUp');
	}, 200);

})
</script>
@endsection
