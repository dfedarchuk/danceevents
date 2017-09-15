<?php

namespace ArcaSolutions\CoreBundle\Exception;


use Exception;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DuplicateItemException extends HttpException
{
    /**
     * DuplicateItemException constructor.
     *
     * @param string $message
     * @param Exception $previous
     */
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct(0, $message, $previous, [], Codes::HTTP_CONFLICT);
    }
}
