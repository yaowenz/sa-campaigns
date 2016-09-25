<?php
namespace App\Http\Controllers;

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
    
    public function getSubmit() {
    	return $this->view('submit');
    }
    
    public function postSubmit() {
    	//return $this->view('index');
    }
    
    public function getSuccess() {
    	return $this->view('success');
    }
}
