<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ empty($pageTitle) ? '' : $pageTitle }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
		<link rel="stylesheet" href="{{asset('css/normalize.css')}}">
		<link rel="stylesheet" href="{{asset('css/animate.css')}}">
        <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>
        <script src="{{asset('js/plugins.js')}}"></script>
        <script src="{{asset('js/vendor/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset('js/vendor/fastclick.js')}}"></script>        
    </head>
    <body>
		@yield('content')
		<script>
		if ('addEventListener' in document) {
			document.addEventListener('DOMContentLoaded', function() {
   	        	FastClick.attach(document.body);
   	    	}, false);
	   	}
       </script>
    </body>
</html>
