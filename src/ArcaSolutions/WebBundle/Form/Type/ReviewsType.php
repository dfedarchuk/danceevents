<?php

namespace ArcaSolutions\WebBundle\Form\Type;

use ArcaSolutions\CoreBundle\Entity\Contact;
use ArcaSolutions\WebBundle\Entity\Accountprofilecontact;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class ReviewsType extends AbstractType
{
    /**
     * @var Accountprofilecontact
     */
    private $account;

    /**
     * @var Registry
     */
    private $doctrine;

    public function __construct($account = null, $doctrine = null)
    {
        $this->account = $account;
        $this->doctrine = $doctrine;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->account) {
            $name = $this->account->getFirstName();

            $contactMain = $this->doctrine->getRepository('CoreBundle:Contact',
                'main')->find($this->account->getAccountId());
            $email = $contactMain->getEmail();
        } else {
            $name = null;
            $email = null;
        }

        $builder
            ->add('name', 'text', [
                'label'       => 'Name',
                'attr'        => ['placeholder' => 'Name', 'max_length' => '100'],
                'data'        => $name,
                'constraints' => new NotBlank(['message' => 'Please type your Name.']),
            ])
            ->add('title', 'text', [
                'label'       => 'Review Title',
                'attr'        => ['placeholder' => 'Type a title for your comment', 'max_length' => '100'],
                'constraints' => new NotBlank(['message' => 'Please type an title for your review.']),
            ])
            ->add('email', 'email', [
                'label'       => 'Email',
                'data'        => $email,
                'attr'        => ['placeholder' => 'Will not be displayed publicly', 'max_length' => '60'],
                'required'    => false,
                'constraints' => [
                    new Email(['message' => 'Please enter a valid e-mail address.']),
                ],
            ])
            ->add('location', 'text', [
                'label'    => 'City, State',
                'attr'     => ['placeholder' => 'Location', 'max_length' => '150'],
                'required' => false,
            ])
            ->add('message', 'textarea', [
                'label'       => 'Your Review',
                'attr'        => ['rows' => 15, 'max_length' => '600'],
                'constraints' => new NotBlank(['message' => 'Please type the message.']),
            ])
            ->add('rating', 'hidden', [
                'required'    => true,
                'label'       => 'Rate it',
                'constraints' => [
                    new NotBlank(['message' => 'Please type the rating.']),
                    new Range(['min' => 1, 'max' => 5]),
                ],
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true,
        ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'edirReviews';
    }
}
