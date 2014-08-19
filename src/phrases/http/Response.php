<?php
namespace Phrases\Http;

/**
 * Class Response
 *
 * @package Phrases\Http
 */
class Response
{
    /**
     * @param string $type
     */
    public static function contentType($type = 'text/txt')
    {
        header('Content-type: '.$type);
    }
} 