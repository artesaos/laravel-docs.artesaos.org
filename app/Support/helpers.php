<?php

if(!function_exists('is_https')){
	function is_https(){
		/** @var \Illuminate\Http\Request $request */
		static $request;

		if(!$request){
			$request = app('request');
		}

		return $request->isSecure() or ($request->getScheme() == 'https');
	}
}
