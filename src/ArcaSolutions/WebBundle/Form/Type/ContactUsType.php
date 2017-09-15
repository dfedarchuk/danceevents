<?php

namespace ArcaSolutions\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactUsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text', [
                'label' => 'First Name',
                'attr' => ['placeholder' => 'Your First Name'],
                'constraints' => new NotBlank(['message' => 'Please type the your First Name.'])
            ])
            ->add('lastname', 'text', [
                'label' => 'Last Name',
                'attr' => ['placeholder' => 'Your Last Name'],
                'constraints' => new NotBlank(['message' => 'Please type the your Last Name.'])
            ])
            ->add('email', 'email', [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Your e-mail, please'],
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a valid e-mail address.']),
                    new Email(['message' => 'Please enter a valid e-mail address.'])
                ]
            ])
            ->add('phone', 'tel', [
                'label' => 'Phone Number',
                'attr' => ['placeholder' => 'Add your phone number (optional)'],
                'required' => false
            ])
            ->add('subject', 'text', [
                'label' => 'Subject',
                'attr' => ['placeholder' => 'Subject'],
                'constraints' => new NotBlank(['message' => 'Please type a subject.'])
            ])
            ->add('message', 'textarea', [
                'label' => 'Message',
                'constraints' => new NotBlank(['message' => 'Please type the message.'])
            ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'contactus';
    }
}
