<?php

if (!function_exists('markdown')) {
    /**
     * Convert some text to Markdown...
     */
    function markdown($text)
    {
        return (new ParsedownExtra)->text($text);
    }
}

if (!function_exists('remove_http_scheme')) {
    /**
     * Remove scheme http or https from a given url
     * @param $url
     *
     * @return mixed
     */
    function remove_http_scheme($url)
    {
        return str_replace(["http:", 'https:'], '', $url);
    }
}

if (!function_exists('url_without_scheme')) {

    /**
     *
     * Alias to remove_http_scheme
     * @param $url
     *
     * @return mixed
     */
    function url_without_scheme($url)
    {
        return remove_http_scheme(url($url));
    }
}

if (!function_exists('elixir_wihout_scheme')) {
    /**
     *
     * Generate a elixir full url without scheme (http or https)
     *
     * @param $url
     *
     * @return mixed
     */
    function elixir_wihout_scheme($url)
    {
        return url_without_scheme(elixir($url));
    }
}

if (!function_exists('str_bind')) {

    /**
     * Bind a associative array values to equivalente on string with colons.
     * @param       $str
     * @param array $replace
     * @exemple str_bind("Hello :name!", ["name" => "World"]) // "Hello World!"
     * @return mixed
     */
    function str_bind($str, $replace = [])
    {
        $replace = array_sort($replace, function ($value, $key) {
                return mb_strlen($key) * -1;
            });

        foreach ($replace as $key => $value) {
            $str = str_replace(':'.$key, $value, $str);
        }

        return $str;
    }
}
