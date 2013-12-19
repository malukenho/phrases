<?php
namespace Phrases\HTTP;

class Response
{
    public function __construct($statusCode, $message)
    {
        header("HTTP/1.1 {$statusCode} {$message}");
    }

    public static function contentType($mimetype, $encode = 'utf-8')
    {
    	header('Content-Type: '.$mimetype.'; charset='.$encode, true);
    }
}