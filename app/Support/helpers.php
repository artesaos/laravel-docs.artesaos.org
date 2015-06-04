<?php

if(!function_exists('remove_http_protocol')){
	function remove_http_scheme($url){
		return str_replace(["http:", 'https:'], '', $url);
	}
}

if(!function_exists('url_without_prococol')){
	function url_without_scheme($url){
		return remove_http_scheme(url($url));
	}
}

if(!function_exists('elixir_without_prococol')) {
	function elixir_wihout_scheme($url)
	{
		return url_without_scheme(elixir($url));
	}
}
