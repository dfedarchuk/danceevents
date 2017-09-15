<?php

namespace ArcaSolutions\CoreBundle\Form;

use Symfony\Component\Form\Form;

interface BuilderInterface
{
    /**
     * Implements the routine for adding the custom fields on form
     *
     * @return array
     */
    public function parse();

    /**
     * Insert the fields on form
     *
     * @param Form $form
     * @param array $fields
     */
    public function generate(Form $form, array $fields);

    /**
     * Serialize the information of the form for save in database
     *
     * @param Form $form
     *
     * @return array
     */
    public function serialize(Form $form);
}