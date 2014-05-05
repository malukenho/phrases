<?php
namespace Phrases\Http;


class Response
{
    public static function contentType($type = 'text/txt')
    {
        header('Content-type: '.$type);
    }
} 