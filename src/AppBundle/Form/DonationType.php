<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DonationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', MoneyType::class, array(
                'label' => 'Montant',
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom',
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom',
            ))
            ->add('address', TextType::class, array(
                'label' => 'Adresse',
            ))
            ->add('postalCode', TextType::class, array(
                'label' => 'Code postal',
            ))
            ->add('city', TextType::class, array(
                'label' => 'Commune',
            ))
            ->add('country', CountryType::class, array(
                'label' => 'Pays de résidence',
            ))
            ->add('nationality', CountryType::class, array(
                'label' => 'Nationalité',
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Adresse de courriel',
            ))
            ->add('phoneNumber', TextType::class, array(
                'label' => 'Téléphone fixe',
            ))
            ->add('comments', TextareaType::class, array(
                'label' => 'Remarques',
            ))
            ->add('paymentMode', ChoiceType::class, array(
                'choices' => array(
                    'Carte bancaire ( Vous serez redirigé-e vers la page de paiement à la validation de l\'adhésion)' => 'online',
                    'Par chèque ( libellé à l\'ordre de AFPG
                                 et envoyé au siège du PG, 20-22 rue Doudeauville,
                                 75018 PARIS, en précisant sur l\'enveloppe "Adhésion" )' => 'onsite',
                ),
                'expanded' => true,
                'label' => 'Mode de paiement',
            ));
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Donation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_donation';
    }
}
