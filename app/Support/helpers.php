<?php

if(!function_exists('is_https')){
	function is_https(){
		return app('request')->isSecure() or app('request')->getScheme() =='https';
	}
}
