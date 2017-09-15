<?php

namespace ArcaSolutions\WebBundle\Form\Builder;

use ArcaSolutions\CoreBundle\Form\Builder;
use ArcaSolutions\CoreBundle\Inflector;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Form;

class EnquireBuilder extends Builder
{
    /**
     * @param Finder $finder optional
     * @param string $folder optional
     * @param string $file optional
     */
    public function __construct(Finder $finder = null, $folder = null, $file = null)
    {
        parent::__construct($finder, $folder, $file);
    }

    /**
     * @inheritdoc
     */
    public function parse()
    {
        $file = $this->getRealPath();
        if (is_file($file)) {
            $content = json_decode(file_get_contents($file), true);
        }

        return isset($content) ? $content : false;
    }

    /**
     * @inheritdoc
     */
    public function serialize(Form $form)
    {
        /* Adjust the fields for serialize */
        $data = $form->getData();
        $lead = [];
        foreach ($data as $name => $value) {
            $name = mb_strpos($name, self::PREFIX) !== false ? mb_substr($name, 7) : $name;
            $key = Inflector::humanize($name);
            if (array_key_exists($key, $lead)) {
                $key = '-'.$key;
            }

            if (is_array($value)) {
                $field = $this->getField($name);
                $_value = PHP_EOL;

                foreach ($field['values'] as $item => $response) {
                    if (!empty($response['value'])) {
                        $_response = !in_array(Inflector::friendly_title($response['value']),
                            $value) ? $this->translator->trans('No') : $this->translator->trans('Yes');
                        $_value .= '- '.Inflector::humanize($response['value']);
                        $_value .= ': '.$_response.PHP_EOL;
                    }
                }
                $value = $_value;
            }

            $lead[$key] = $value.PHP_EOL;
        }

        unset($data);

        return serialize($lead);
    }
}
