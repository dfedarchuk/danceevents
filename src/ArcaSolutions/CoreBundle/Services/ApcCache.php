<?php
namespace ArcaSolutions\CoreBundle\Services;

use Doctrine\Common\Cache\ApcuCache;
use Symfony\Component\HttpFoundation\RequestStack;

class ApcCache extends ApcuCache
{
    /**
     * @var RequestStack
     */
    private $request;

    /**
     * Used to prepend ids to divide caches files
     *
     * @var string
     */
    private $prepend;

    /**
     * ApcCache constructor.
     *
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        $this->request = $request;

        /* caches per domain */
        $this->prepend = $this->request->getCurrentRequest()->getHost();
    }

    /**
     * {@inheritdoc}
     */
    public function contains($id)
    {
        return parent::contains($this->appendDomainInformationInID($id));
    }

    /**
     * @param $id
     *
     * @return string
     */
    private function appendDomainInformationInID($id)
    {
        return $this->prepend.$id;
    }

    /**
     * {@inheritdoc}
     */
    public function fetch($id)
    {
        return parent::fetch($this->appendDomainInformationInID($id));
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        return parent::delete($this->appendDomainInformationInID($id));
    }

    /**
     * @param string $id
     * @param mixed $data
     * @param int $lifeTime The default value means: 60*60*24*31 (one month in seconds). It prevents storing cache that will not be used.
     *
     * @return bool
     */
    public function save($id, $data, $lifeTime = 2678400)
    {
        return parent::save($this->appendDomainInformationInID($id), $data, $lifeTime);
    }
}
