<?php

namespace ArcaSolutions\MultiDomainBundle\HttpFoundation;

use Symfony\Component\HttpFoundation\Request;

class MultiDomainRequest extends Request
{
    /**
     * Returns the host name.
     *
     * This method can read the client port from the "X-Forwarded-Host" header
     * when trusted proxies were set via "setTrustedProxies()".
     *
     * The "X-Forwarded-Host" header must contain the client host name.
     *
     * If your reverse proxy uses a different header name than "X-Forwarded-Host",
     * configure it via "setTrustedHeaderName()" with the "client-host" key.
     *
     * @return string
     *
     * @throws \UnexpectedValueException when the host name is invalid
     *
     * @api
     */
    public function getHost()
    {
        $host = parent::getHost();

        $host = str_replace('www.', '', $host);

        return $host;
    }
}