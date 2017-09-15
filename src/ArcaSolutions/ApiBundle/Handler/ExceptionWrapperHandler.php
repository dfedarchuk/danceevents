<?php

namespace ArcaSolutions\ApiBundle\Handler;


use FOS\RestBundle\View\ExceptionWrapperHandlerInterface;

class ExceptionWrapperHandler implements ExceptionWrapperHandlerInterface
{
    public function wrap($data)
    {
        /** @var \Symfony\Component\Debug\Exception\FlattenException $exception */
        //$exception = $data['exception'];
        if (isset($data['exception'])) {
            unset($data['exception']);
        }
        $newException = array(
            'error' => array(
                $data
            )
        );

        return $newException;
    }
}