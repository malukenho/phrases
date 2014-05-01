<?php
namespace Phrases\http;


class Response
{
    public static function contentType($type = 'text/txt')
    {
        header('Content-type: '.$type);
    }
} 