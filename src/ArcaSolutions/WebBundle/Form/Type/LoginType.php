<?php

namespace ArcaSolutions\WebBundle\Form\Type;


use ArcaSolutions\CoreBundle\Services\AccountHandler;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', [
                'constraints' => new NotBlank(),
            ])
            ->add('password', 'password', [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => AccountHandler::PASSWORD_MIN_LEN,
                        'max' => AccountHandler::PASSWORD_MAX_LEN,
                    ]),
                ],
            ]);
    }

    public function getName()
    {
        return 'edirLogin';
    }
}
