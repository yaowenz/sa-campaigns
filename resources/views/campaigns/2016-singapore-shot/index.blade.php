@extends('layouts.mobile')

@section('content')
<style>
@import url('{{asset('campaigns/2016-singapore-shot/main.css')}}')
</style>
<audio id="bg-music" loop preload="auto" src="{{asset('campaigns/2016-singapore-shot/i/bg.mp3')}}"></audio>
<img class="logos-top" src="{{asset('campaigns/2016-singapore-shot/i/logos-top.png')}}" width="60%" />
<img class="animated fadeIn" style="position:absolute;top:15%" src="{{asset('campaigns/2016-singapore-shot/i/index-title.png')}}" width="100%" />
<a href="{{action('SingaporeShot2016@getSignup')}}"><img class="next hide" style="padding:30px 0px 30px 30px;position:absolute;top:calc(50% - 25px);right:15px" src="{{asset('campaigns/2016-singapore-shot/i/next.png')}}" height="40" /></a>
<div style="position:absolute;bottom:0px;text-align:center;background-color:rgba(255,255,255,0.7);padding:20px 0px 16px 0px">
	<img src="{{asset('campaigns/2016-singapore-shot/i/partners.png')}}" width="95%" />
</div>
<script>
$(function () {
	setTimeout(function() {
		$('.next').removeClass('hide');
		$('.next').addClass('animated fadeInLeft');
	}, 200);

	$('#bg-music')[0].play();
})

var hammertime = new Hammer(document.body);
hammertime.on('swipeleft', function(ev) {
	location.href = '{{action('SingaporeShot2016@getSignup')}}';
});

</script>
@endsection
