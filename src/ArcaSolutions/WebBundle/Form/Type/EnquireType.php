<?php

namespace ArcaSolutions\WebBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class EnquireType extends ContactUsType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "EnquireForm";
    }
}