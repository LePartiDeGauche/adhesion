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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class JoiningType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isRenewed', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    'Première adhésion' => false,
                    'Renouvellement' => true,
                ),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom',
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom',
            ))
            ->add('gender', ChoiceType::class , array(
                'label' => 'Genre',
                'choices' => array(
                    'Homme' => 'M',
                    'Femme' => 'F',
                    'Autre' => '?',
                )
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
            ->add('country', TextType::class, array(
                'label' => 'Pays',
            ))
            ->add('department', ChoiceType::class , array(
                'label' => 'Département',
                'choices' => $this->getDepartementChoices(),
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Adresse de courriel',
            ))
            ->add('birthdate', BirthdayType::class, array(
                'label' => 'Date de naissance',
            ))
            ->add('phoneNumber', TextType::class, array(
                'label' => 'Téléphone fixe',
            ))
            ->add('mobilephone', TextType::class, array(
                'label' => 'Téléphone mobile',
            ))
            ->add('job', TextType::class, array(
                'label' => 'Profession',
            ))
            ->add('electiveMandate', TextType::class, array(
                'label' => 'Mandat électif',
            ))
            ->add('mandateLocation', TextType::class, array(
                'label' => 'Lieu d\'exercice',
            ))
            ->add('tradeUnionCommitment', TextType::class, array(
                'label' => 'Engagements syndicaux',
            ))
            ->add('associativeCommitment', TextType::class, array(
                'label' => 'Engagements associatifs',
            ))
            ->add('responsabilities', ChoiceType::class, array(
                'label' => 'Responsabilités',
                'choices' => array(
                    'Locales' => 'local',
                    'Départementales' => 'dept',
                    'Nationales' => 'nation',
                )
            ))
            ->add('comments', TextareaType::class, array(
                'label' => 'Remarques',
            ))
            ->add('membershipFee', EntityType::class, array(
                'class' => 'AppBundle:MembershipFee',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
                'label' => 'Cotisation',
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
            'data_class' => 'AppBundle\Entity\Joining'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_joining';
    }

    protected function getDepartementChoices()
    {
        return array(
            'Ain (01)' => 'Ain (01)',
            'Aisne (02)' => 'Aisne (02)',
            'Allier (03)' => 'Allier (03)',
            'Alpes-de-Haute-Provence (04)' => 'Alpes-de-Haute-Provence (04)',
            'Hautes-Alpes (05)' => 'Hautes-Alpes (05)',
            'Alpes-Maritimes (06)' => 'Alpes-Maritimes (06)',
            'Ardèche (07)' => 'Ardèche (07)',
            'Ardennes (08)' => 'Ardennes (08)',
            'Ariège (09)' => 'Ariège (09)',
            'Aube (10)' => 'Aube (10)',
            'Aude (11)' => 'Aude (11)',
            'Aveyron (12)' => 'Aveyron (12)',
            'Bouches-du-Rhône (13)' => 'Bouches-du-Rhône (13)',
            'Calvados (14)' => 'Calvados (14)',
            'Cantal (15)' => 'Cantal (15)',
            'Charente (16)' => 'Charente (16)',
            'Charente-Maritime (17)' => 'Charente-Maritime (17)',
            'Cher (18)' => 'Cher (18)',
            'Corrèze (19)' => 'Corrèze (19)',
            'Corse-du-Sud (2A)' => 'Corse-du-Sud (2A)',
            'Haute-Corse (2B)' => 'Haute-Corse (2B)',
            'Côte-d\'Or (21)' => 'Côte-d\'Or (21)',
            'Côtes-d\'Armor (22)' => 'Côtes-d\'Armor (22)',
            'Creuse (23)' => 'Creuse (23)',
            'Dordogne (24)' => 'Dordogne (24)',
            'Doubs (25)' => 'Doubs (25)',
            'Drôme (26)' => 'Drôme (26)',
            'Eure (27)' => 'Eure (27)',
            'Eure-et-Loir (28)' => 'Eure-et-Loir (28)',
            'Finistère (29)' => 'Finistère (29)',
            'Gard (30)' => 'Gard (30)',
            'Haute-Garonne (31)' => 'Haute-Garonne (31)',
            'Gers (32)' => 'Gers (32)',
            'Gironde (33)' => 'Gironde (33)',
            'Hérault (34)' => 'Hérault (34)',
            'Ille-et-Vilaine (35)' => 'Ille-et-Vilaine (35)',
            'Indre (36)' => 'Indre (36)',
            'Indre-et-Loire (37)' => 'Indre-et-Loire (37)',
            'Isère (38)' => 'Isère (38)',
            'Jura (39)' => 'Jura (39)',
            'Landes (40)' => 'Landes (40)',
            'Loir-et-Cher (41)' => 'Loir-et-Cher (41)',
            'Loire (42)' => 'Loire (42)',
            'Haute-Loire (43)' => 'Haute-Loire (43)',
            'Loire-Atlantique (44)' => 'Loire-Atlantique (44)',
            'Loiret (45)' => 'Loiret (45)',
            'Lot (46)' => 'Lot (46)',
            'Lot-et-Garonne (47)' => 'Lot-et-Garonne (47)',
            'Lozère (48)' => 'Lozère (48)',
            'Maine-et-Loire (49)' => 'Maine-et-Loire (49)',
            'Manche (50)' => 'Manche (50)',
            'Marne (51)' => 'Marne (51)',
            'Haute-Marne (52)' => 'Haute-Marne (52)',
            'Mayenne (53)' => 'Mayenne (53)',
            'Meurthe-et-Moselle (54)' => 'Meurthe-et-Moselle (54)',
            'Meuse (55)' => 'Meuse (55)',
            'Morbihan (56)' => 'Morbihan (56)',
            'Moselle (57)' => 'Moselle (57)',
            'Nièvre (58)' => 'Nièvre (58)',
            'Nord (59)' => 'Nord (59)',
            'Oise (60)' => 'Oise (60)',
            'Orne (61)' => 'Orne (61)',
            'Pas-de-Calais (62)' => 'Pas-de-Calais (62)',
            'Puy-de-Dôme (63)' => 'Puy-de-Dôme (63)',
            'Pyrénées-Atlantiques (64)' => 'Pyrénées-Atlantiques (64)',
            'Hautes-Pyrénées (65)' => 'Hautes-Pyrénées (65)',
            'Pyrénées-Orientales (66)' => 'Pyrénées-Orientales (66)',
            'Bas-Rhin (67)' => 'Bas-Rhin (67)',
            'Haut-Rhin (68)' => 'Haut-Rhin (68)',
            'Rhône (69)' => 'Rhône (69)',
            'Haute-Saône (70)' => 'Haute-Saône (70)',
            'Saône-et-Loire (71)' => 'Saône-et-Loire (71)',
            'Sarthe (72)' => 'Sarthe (72)',
            'Savoie (73)' => 'Savoie (73)',
            'Haute-Savoie (74)' => 'Haute-Savoie (74)',
            'Paris (75)' => 'Paris (75)',
            'Seine-Maritime (76)' => 'Seine-Maritime (76)',
            'Seine-et-Marne (77)' => 'Seine-et-Marne (77)',
            'Yvelines (78)' => 'Yvelines (78)',
            'Deux-Sèvres (79)' => 'Deux-Sèvres (79)',
            'Somme (80)' => 'Somme (80)',
            'Tarn (81)' => 'Tarn (81)',
            'Tarn-et-Garonne (82)' => 'Tarn-et-Garonne (82)',
            'Var (83)' => 'Var (83)',
            'Vaucluse (84)' => 'Vaucluse (84)',
            'Vendée (85)' => 'Vendée (85)',
            'Vienne (86)' => 'Vienne (86)',
            'Haute-Vienne (87)' => 'Haute-Vienne (87)',
            'Vosges (88)' => 'Vosges (88)',
            'Yonne (89)' => 'Yonne (89)',
            'Territoire de Belfort (90)' => 'Territoire de Belfort (90)',
            'Essonne (91)' => 'Essonne (91)',
            'Hauts-de-Seine (92)' => 'Hauts-de-Seine (92)',
            'Seine-Saint-Denis (93)' => 'Seine-Saint-Denis (93)',
            'Val-de-Marne (94)' => 'Val-de-Marne (94)',
            'Val-d\'Oise (95)' => 'Val-d\'Oise (95)',
            'Guadeloupe (971)' => 'Guadeloupe (971)',
            'Martinique (972)' => 'Martinique (972)',
            'Guyane (973)' => 'Guyane (973)',
            'La Réunion (974)' => 'La Réunion (974)',
            'Saint-Pierre et Miquelon (975)' => 'Saint-Pierre et Miquelon (975)',
            'Mayotte (976)' => 'Mayotte (976)',
            'Étranger' => 'Étranger',
        );
    }

}
