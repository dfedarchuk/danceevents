<?php

namespace ArcaSolutions\CoreBundle\Form;

use ArcaSolutions\CoreBundle\Inflector;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Form;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

abstract class Builder implements BuilderInterface
{
    const PREFIX = 'custom_';

    /**
     * @var array
     */
    protected $fieldDictionary = [
        'input_text' => 'text',
        'textarea'   => 'textarea',
        'checkbox'   => 'checkbox',
        'radio'      => 'radio',
        'select'     => 'select',
    ];

    /**
     * @var string
     */
    private $folder;

    /**
     * @var string
     */
    private $file;

    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param Finder $finder Options
     * @param string $folder Options
     * @param string $file Options
     */
    public function __construct(Finder $finder = null, $folder = null, $file = null)
    {
        if (!is_null($finder)) {
            $this->finder = $finder;
        } else {
            $this->finder = new Finder();
        }
    }

    /**
     * @param string $path
     */
    public function setFolder($path)
    {
        $this->folder = $path;
    }

    /**
     * @param string $name
     */
    public function setFile($name)
    {
        $this->file = $name;
    }

    /**
     * @param TranslatorInterface $trans
     */
    public function setTranslator(TranslatorInterface $trans)
    {
        $this->translator = $trans;
    }

    /**
     * @param string $key Form Type in JSON
     * @param string $value Form Type in Symfony Form
     */
    public function addFieldDictionary($key, $value)
    {
        $this->fieldDictionary[$key] = $value;
    }

    /**
     * @inheritdoc
     */
    public function generate(Form $form, array $fields = null)
    {
        if (is_null($fields)) {
            if (!$fields = $this->parse()) {
                return false;
            }
        }

        foreach ($fields as $field) {
            /* Ignores type undefined */
            if ($field['cssClass'] == 'undefined') {
                continue;
            }

            /* Search the field type in the dictionary */
            $type = $this->fieldDictionary[$field['cssClass']];

            $options = [
                'required'    => false,
                'constraints' => [],
            ];

            /* Adds field options on form */
            if ($field['required'] == 'true') {
                $options = [
                    'required'    => true,
                    'constraints' => new NotBlank(['message' => 'The field is required']),
                ];
            }

            if (!is_array($field['values'])) {
                $options = array_merge($options, [
                    /** @Ignore */
                    'label' => Inflector::humanize($field['values']),
                ]);

                if ($field['cssClass'] == "textarea") {
                    $options['attr'] = ['rows' => 10];
                }

                $form->add(self::PREFIX.Inflector::friendly_title($field['values']), $type, $options);
            } else {
                $choices = [];
                foreach ($field['values'] as $key => $item) {
                    if (!empty($item['value'])) {
                        $choices[Inflector::friendly_title($item['value'])] = $item['value'];
                    }
                }

                /* Adds new field options on form */
                $_options = [
                    /** @Ignore */
                    'label'    => Inflector::humanize($field['title']),
                    'choices'  => $choices,
                    'multiple' => $type == 'checkbox' ? true : false,
                    'expanded' => $type == 'select' ? false : true,
                ];

                $options = array_merge($options, $_options);

                /* Adds new field on form */
                $form->add(self::PREFIX.Inflector::friendly_title($field['title']), 'choice', $options);
            }
        }
    }

    /**
     * @param string $name
     * @return array
     *
     */
    public function getField($name)
    {
        $fields = $this->parse();

        foreach ($fields as $field) {
            /* Ignores type undefined */
            if ($field['cssClass'] == 'undefined') {
                continue;
            }

            $key = !is_array($field['values']) ? 'values' : 'title';

            if (Inflector::friendly_title($field[$key]) == $name) {
                return $field;
            }
        }

        return [];
    }

    /**
     * Gets the real path of the configuration file
     *
     * @return string|null
     */
    protected function getRealPath()
    {
        $this->finder->files()->in($this->folder)->name($this->file);
        foreach ($this->finder as $_file) {
            $file = $_file;
        }

        return isset($file) ? $file : null;
    }
}
