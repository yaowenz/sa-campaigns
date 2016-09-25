@extends('layouts.mobile')

@section('content')
<style>
@import url('{{asset('campaigns/2016-singapore-shot/main.css')}}')
</style>

<img class="logos-top" src="{{asset('campaigns/2016-singapore-shot/i/logos-top.png')}}" width="60%" />
<img class="animated fadeIn" style="position:absolute;top:15%" src="{{asset('campaigns/2016-singapore-shot/i/submit-title.png')}}" width="100%" />
<a href="{{action('SingaporeShot2016@getSignup')}}"><img class="next hide" style="padding:30px;position:absolute;top:calc(50% - 25px);right:-15px" src="{{asset('campaigns/2016-singapore-shot/i/next.png')}}" height="50px" /></a>
<form method="GET" action="{{action('SingaporeShot2016@getSubmit')}}"></form>
<div class="form hide">
	<div style="background-color:rgba(255,255,255,0.5);margin:0 15%;border-radius:20px;width:70%;position:absolute;top:28%">
		<div class="input-round" style="background-color:#e8323f">
			<span>作者：</span>
			<input type="text" name="author" />
		</div>
		<div class="input-round" style="background-color:#00539d">
			<span>电话：</span>
			<input type="text" name="mobile" />
		</div>
		<div class="input-round" style="background-color:#f8b72a">
			<span>作品名：</span>
			<input type="text" name="photo_title" />
		</div>
	</div>
</div>
<div style="position:absolute;bottom:0px;text-align:center;background-color:rgba(0,0,0,0.4);padding:18px 0px;width:100%">
	<img class="submit-shot" src="{{asset('campaigns/2016-singapore-shot/i/shot.png')}}" width="95%" />
</div>
</form>
<script>
$(function () {
	setTimeout(function() {
		$('.form').removeClass('hide');
		$('.form').addClass('animated fadeIn');
	}, 200);
	
	$('.submit-shot').click(function() {
		if($('input[name=author]').val() == '') {
			alert('请输入作者姓名');
			return false;
		}
		if($('input[name=mobile]').val() == '') {
			alert('请输入联系电话');
			return false;
		}
		if($('input[name=photo_title]').val() == '') {
			alert('请输入作品名称');
			return false;
		}
		
		$('form').submit();
	});
})
</script>
@endsection
