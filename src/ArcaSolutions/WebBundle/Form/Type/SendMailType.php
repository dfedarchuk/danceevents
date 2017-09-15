<?php

namespace ArcaSolutions\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SendMailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', ['label' => 'Name'])
            ->add('email', 'email', ['label' => 'Your e-mail, please'])
            ->add('subject', 'text', ['label' => 'Subject'])
            ->add('text', 'textarea', ['label' => 'Additional message']);
    }

    /**
     * Sets validation class
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'ArcaSolutions\WebBundle\Entity\SendMail',
            'intention'  => 'sendMail'
        ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'send_mail';
    }
}
