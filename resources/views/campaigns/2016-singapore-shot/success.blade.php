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
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
$(function () {
	setTimeout(function() {
		$('.share').removeClass('hide');
		$('.share').addClass('animated fadeInUp');
	}, 200);

	// WXJs Api
	wx.config({
	    debug: false, 
	    appId: '{{$wx_js->appId or ''}}', 
	    timestamp: {{$wx_js->timestamp or ''}}, 
	    nonceStr: '{{$wx_js->nonceStr or ''}}',
	    signature: '{{$wx_js->signature or ''}}',
	    jsApiList: ['onMenuShareAppMessage', 'onMenuShareTimeline'] 
	});	

	wx.ready(function(){		
		wx.onMenuShareTimeline({
			title: '快和我一起参加【魅力新加坡】，上传新加坡照片，赢取丰厚大礼！',			
			link: '{{action('SingaporeShot2016@getIndex')}}',
		    imgUrl: '{{asset('campaigns/2016-singapore-shot/i/share-thumb.jpg')}}',
		    success: function () {},
		    cancel: function () {}
		});
		wx.onMenuShareAppMessage({			
			title: '魅力新加坡', 
			desc: '快和我一起参加【魅力新加坡】，上传新加坡照片，赢取丰厚大礼！',
		    link: '{{action('SingaporeShot2016@getIndex')}}',
		    imgUrl: '{{asset('campaigns/2016-singapore-shot/i/share-thumb.jpg')}}',		    
		});
	});
})

</script>
@endsection
