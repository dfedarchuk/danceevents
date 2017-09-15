<?php

namespace ArcaSolutions\WebBundle\Form\Type;


use ArcaSolutions\CoreBundle\Services\AccountHandler;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text', [
                'constraints' => new NotBlank(),
            ])
            ->add('lastname', 'text', [
                'constraints' => new NotBlank(),
            ])
            ->add('email', 'text', [
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ])
            ->add('password', 'password', [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => AccountHandler::PASSWORD_MIN_LEN,
                        'max' => AccountHandler::PASSWORD_MAX_LEN,
                    ]),
                ],
            ])
            ->add('terms', 'checkbox');
    }

    public function getName()
    {
        return 'edirAccount';
    }
}
