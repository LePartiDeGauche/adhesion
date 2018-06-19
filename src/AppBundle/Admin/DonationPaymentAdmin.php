<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DonationPaymentAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('amount')
            ->add('method')
            ->add('status')
            ->add('drawer')
            ->add('date')
            ->add('account')
            ->add('referenceIdentifierPrefix')
            ->add('paymentIPN')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('amount')
            ->add('method')
            ->add('status')
            ->add('drawer')
            ->add('date')
            ->add('account')
            ->add('referenceIdentifierPrefix')
            ->add('paymentIPN')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('amount')
            ->add('method')
            ->add('status')
            ->add('drawer')
            ->add('date')
            ->add('account')
            ->add('referenceIdentifierPrefix')
            ->add('paymentIPN')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('amount')
            ->add('method')
            ->add('status')
            ->add('drawer')
            ->add('date')
            ->add('account')
            ->add('referenceIdentifierPrefix')
            ->add('paymentIPN')
        ;
    }
}
