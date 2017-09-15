<?php

namespace ArcaSolutions\SearchBundle\Exceptions;


class NotFoundException extends \Exception
{
    public function __construct($message = null, $code = 0, \Exception $previous = null) {
        $message or $message = "The requested item was not found.";
        parent::__construct($message, $code, $previous);
    }
}