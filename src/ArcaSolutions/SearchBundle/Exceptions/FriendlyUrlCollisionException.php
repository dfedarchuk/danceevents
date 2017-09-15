<?php

namespace ArcaSolutions\SearchBundle\Exceptions;


class FriendlyUrlCollisionException extends \Exception
{
    public function __construct( $information, $message = null, $code = 0, \Exception $previous = null) {
        $message or $message = "There are two items with the same friendlyUrl.\n Information: $information";
        parent::__construct($message, $code, $previous);
    }
}