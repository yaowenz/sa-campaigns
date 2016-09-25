<?php
namespace App\Http\Controllers;

use Illuminate\Cache\RateLimiter;
use App\Models\SingaporeShot2016Data;

class SingaporeShot2016 extends Controller
{
    public function view($view, $data = []) {
    	$view = "campaigns.2016-singapore-shot.{$view}";    	
    	$data['pageTitle'] = '魅力新加坡';    	
    	return view($view, $data);
    }
    
    public function getIndex() {
    	return $this->view('index');
    }
    
    public function getSignup() {
    	return $this->view('signup');
    }
    
    public function postSignup() {
    	
    	$limiter = app()->make(RateLimiter::class);
    	if($limiter->tooManyAttempts('_2016_singapore_shot_upload', 2, 1)) {
    		\Session::flash('_input_too_frequency', 1);
    		return \Redirect::back();
    	}
    	else {
    		$limiter->hit('_2016_singapore_shot_upload');
    	}    	
    	
    	$data = \Input::all();
    	$validator = \Validator::make($data, [
    		'author' => 'required|max:50',
    		'photo_title' => 'required|max:50',
    		'mobile' => 'required|max:20',
    		'photo_file' => 'required|max:5000|mimes:jpg,jpeg'
    	]);    
    	
    	if($validator->fails()) {
    		\Session::flash('_error_input', 1);
    		return \Redirect::back();
    	}    	
    	
    	$filename = date('YmdHis') . "-{$data['mobile']}.jpg";    
    	$filesize = \Input::file('photo_file')->getSize();
    	\Input::file('photo_file')->move(base_path('public/uploads/2016-singapore-shot'), $filename);    
    	
    	$row = new SingaporeShot2016Data();
    	$row->author = $data['author'];
    	$row->title = $data['photo_title'];
    	$row->mobile = $data['mobile'];
    	$row->file_size = $filesize;
    	$row->file_path = 'uploads/2016-singapore-shot/' . $filename;
    	$row->save();
    	
    	$allowed_photo_ids = \Session::has('_allowed_photo_ids') ? \Session::get('_allowed_photo_ids') : [];
    	$allowed_photo_ids[] = $row->id;
    	\Session::set('_allowed_photo_ids', $allowed_photo_ids);
    	
    	return \Redirect::action('SingaporeShot2016@getSubmit', $row->id);
    	
    }
    
    public function getSubmit($id) {
    	$allowed = \Session::get('_allowed_photo_ids');
    	if(empty($allowed)) $allowed = [];
    	
    	if(!in_array($id, $allowed)) {
    		return \Redirect::action('SingaporeShot2016@getSignup');
    	}
    	
    	$photo = SingaporeShot2016Data::find($id);
    	
    	return $this->view('submit', ['photo' => $photo]);
    }
    
    public function postSubmit() {    	
    	
    	$data = \Input::all();
    	$validator = \Validator::make($data, [
	    	'id' => 'required|max:50',
	    	'story' => 'required|max:200',
    	]);
    	
    	if($validator->fails()) {
    		\Session::flash('_error_input', 1);
    		return \Redirect::back();
    	}
    	
    	$allowed = \Session::get('_allowed_photo_ids');
    	if(empty($allowed)) $allowed = [];
    	 
    	if(!in_array($data['id'], $allowed)) {
    		return \Redirect::action('SingaporeShot2016@getSignup');
    	}
    	
    	$photo = SingaporeShot2016Data::find($data['id']);    	
    	$photo->story = \Input::get('story');
    	$photo->save();
    	
    	return \Redirect::action('SingaporeShot2016@getSuccess');
    }
    
    public function getSuccess() {
    	return $this->view('success');
    }
}
