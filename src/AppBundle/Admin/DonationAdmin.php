<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class DonationAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('pdf', $this->getRouterIdParameter().'/pdf');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('lastname')
            ->add('firstname')
            // ->add('address')
            // ->add('postalCode')
            // ->add('city')
            // ->add('country')
            // ->add('email')
            // ->add('phoneNumber')
            // ->add('comments')
            // ->add('amount')
            ->add('paymentMode')
            // ->add('createdAt')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'pdf' => [
                        'template' => 'admin/list__action_pdf.html.twig'
                    ]
                ],
            ])
            ->add('id')
            ->addIdentifier('lastname')
            ->addIdentifier('firstname')
            ->add('city')
            ->add('country')
            ->add('paymentMode')
            ->add('amount')
            ->add('createdAt', null, array(
                'format' => 'd/m/Y',
            ))
            ->add('email')
            ->add('phoneNumber')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('lastname')
            ->add('firstname')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country', CountryType::class, array(
                'placeholder' => true,
            ))
            ->add('nationality', CountryType::class, array(
                'placeholder' => true,
            ))
            ->add('email')
            ->add('phoneNumber')
            ->add('comments')
            ->add('amount')
            ->add('paymentMode')
            ->add('createdAt')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('lastname')
            ->add('firstname')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country', CountryType::class)
            ->add('nationality', CountryType::class)
            ->add('email')
            ->add('phoneNumber')
            ->add('comments')
            ->add('amount')
            ->add('paymentMode')
            ->add('createdAt')
        ;
    }

    public function getExportFormats()
    {
        $formats = parent::getExportFormats();
        return array_merge($formats, array('pdf'));
    }
}
