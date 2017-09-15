<?php

namespace ArcaSolutions\SearchBundle\Exceptions;


class InvalidRoutePathException extends \Exception
{
    public function __construct( $badRoute, $message = null, $code = 0, \Exception $previous = null) {
        $message or $message = "The route '{$badRoute}' is not correctly formated. Valid routes must match the following format: '{module}_search_{numberofparameters}'";
        parent::__construct($message, $code, $previous);
    }
}