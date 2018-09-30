<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DonationAdmin extends AbstractAdmin
{
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
            ->add('country')
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
            ->add('country')
            ->add('email')
            ->add('phoneNumber')
            ->add('comments')
            ->add('amount')
            ->add('paymentMode')
            ->add('createdAt')
        ;
    }
}
