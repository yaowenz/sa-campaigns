@extends('layouts.mobile')

@section('content')
<style>
@import url('{{asset('campaigns/2016-singapore-shot/main.css')}}')
</style>
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
		<input type="checkbox" value="1" name="copyright" style="height:20px;width:20px;background-color:white;border:0px;position:relative;top:5px" />&nbsp;&nbsp;同意照片使用授权		
	</div>
</div>
</form>
<div style="position:absolute;bottom:0px;text-align:center;background-color:#e8323f;padding:18px 0px">
	<img class="submit-upload" src="{{asset('campaigns/2016-singapore-shot/i/upload-btn.png')}}" width="95%" />
</div>
<script>
$(function () {
	setTimeout(function() {
		$('.next').removeClass('hide');
		$('.next').addClass('animated fadeInLeft');
	}, 200);


	$('.submit-upload').click(function() {
		if(!$('input[name=copyright]').prop('checked')) {
			alert('请同意照片使用授权')
			return false;
		}

		if($('textarea[name=story]').val() == '') {
			alert('请填写关于照片的小故事')
			return false;
		}

		$('form').submit();
	})
	
})
</script>
@endsection
