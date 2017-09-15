<?php

namespace ArcaSolutions\ApiBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class SocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('provider', 'text', [
                'constraints' => new NotBlank(),
            ])
            ->add('token', 'text', [
                'constraints' => new NotBlank(),
            ]);
    }
}
