@extends('layouts.mobile')

@section('content')
<style>
@import url('{{asset('campaigns/2016-singapore-shot/main.css')}}')
</style>
<audio id="bg-music" loop preload="auto" src="{{asset('campaigns/2016-singapore-shot/i/bg.mp3')}}"></audio>
<div style="position:absolute;top:5%;width:100%;height:45%;overflow:hidden">
	<img style="margin-left:35px" src="{{asset('campaigns/2016-singapore-shot/i/shot-border-top.png')}}" width="100%" />
	<div style="box-sizing:border-box;padding:0 60px;width:100%;margin:-9% 0px;height:80%">
		<div style="border-radius:20px;background-color:rgba(255,255,255,0.5);background-image:url('{{asset($photo->file_path)}}');background-repeat:no-repeat;background-size:cover;background-position:center;height:100%;width:100%">
		</div>
	</div>
	<img style="margin-left:-35px" src="{{asset('campaigns/2016-singapore-shot/i/shot-border-bottom.png')}}" width="100%" />
</div>
<form method="POST">
<div style="position:absolute;top:50%;width:100%;;overflow:hidden">
	<div class="input-round" style="width:60%;margin:0 20%;background-color:#f8b72a">
		<span>作品名：{{$photo->title}}</span>		
	</div>
	<input type="hidden" name="id" value="{{$photo->id}}" />
	{{csrf_field()}}
	<textarea name="story" placeholder="关于照片的小故事... （最多200字）" style="border-radius:0px;box-sizing:border-box;border:0px;margin-top:15px;width:100%;background-color:rgba(255,255,255,0.9);height:80px;padding:10px;line-height:1.6;font-size:16px"></textarea>
	<div style="margin-top:5px;text-align:center;line-height:30px;font-size:16px;color:white;font-weight:bold">
		<input type="checkbox" value="1" name="copyright" style="height:20px;width:20px;background-color:white;border:0px;position:relative;top:5px" />&nbsp;&nbsp;<span class="copyright-btn">同意《作品版权归属协议》</span>		
	</div>
</div>
</form>
<div class="submit-upload" style="position:absolute;bottom:0px;text-align:center;background-color:#e8323f;padding:18px 0px">
	<img  src="{{asset('campaigns/2016-singapore-shot/i/upload-btn.png')}}" width="95%" />
</div>
<div class="agreement hide" style="color:white;position:absolute;width:80%;top:10%;margin:auto 10%;padding:10px;border-radius:10px;background-color:rgba(0,0,0,0.8)">
	<p style="text-align:center">作品版权归属协议</p>
	<p>1. 本人承诺上传作品为本人独立拍摄或授权拍摄，享有完整的著作权。</p>
	<p>2. 本人保留享有作品的署名权，并授权凯德龙之梦虹口对于本人上传照片的使用权。</p>
	<p>3. 使用期间为2016年10月1日至2016年11月15日。</p>
	<p>4. 本协议未尽事宜，适用于《中华人民共和国著作权》的规定。</p>
	<p style="text-align:center">确定</p>
</div>
<script>
$(function () {
	setTimeout(function() {
		$('.next').removeClass('hide');
		$('.next').addClass('animated fadeInLeft');
	}, 200);

	$('#bg-music')[0].play();

	$('.submit-upload').click(function() {
		if(!$('input[name=copyright]').prop('checked')) {
			alert('请同意《作品版权归属协议》')
			return false;
		}

		if($('textarea[name=story]').val() == '') {
			alert('请填写关于照片的小故事')
			return false;
		}

		$('form').submit();
	})
	
	$('.copyright-btn').click(function() {
		$('.agreement').removeClass('hide');
	});

	$('.agreement').click(function() {
		$(this).addClass('hide');
	})
})
</script>
@endsection
