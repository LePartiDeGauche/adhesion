<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class JoiningAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('isRenewed')
            ->add('lastname')
            ->add('firstname')
            ->add('gender')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('department')
            ->add('localComitee')
            ->add('email')
            ->add('birthdate')
            ->add('phoneNumber')
            ->add('mobilephone')
            ->add('job')
            ->add('electiveMandate')
            ->add('mandateLocation')
            ->add('tradeUnionCommitment')
            ->add('associativeCommitment')
            ->add('responsabilities')
            ->add('comments')
            ->add('paymentMode')
            ->add('joiningDatetime')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('isRenewed')
            ->add('lastname')
            ->add('firstname')
            ->add('gender')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('department')
            ->add('localComitee')
            ->add('email')
            ->add('birthdate')
            ->add('phoneNumber')
            ->add('mobilephone')
            ->add('job')
            ->add('electiveMandate')
            ->add('mandateLocation')
            ->add('tradeUnionCommitment')
            ->add('associativeCommitment')
            ->add('responsabilities')
            ->add('comments')
            ->add('paymentMode')
            ->add('joiningDatetime')
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
            ->add('isRenewed')
            ->add('lastname')
            ->add('firstname')
            ->add('gender')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('department')
            ->add('localComitee')
            ->add('email')
            ->add('birthdate')
            ->add('phoneNumber')
            ->add('mobilephone')
            ->add('job')
            ->add('electiveMandate')
            ->add('mandateLocation')
            ->add('tradeUnionCommitment')
            ->add('associativeCommitment')
            ->add('responsabilities')
            ->add('comments')
            ->add('paymentMode')
            ->add('joiningDatetime')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('isRenewed')
            ->add('lastname')
            ->add('firstname')
            ->add('gender')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('department')
            ->add('localComitee')
            ->add('email')
            ->add('birthdate')
            ->add('phoneNumber')
            ->add('mobilephone')
            ->add('job')
            ->add('electiveMandate')
            ->add('mandateLocation')
            ->add('tradeUnionCommitment')
            ->add('associativeCommitment')
            ->add('responsabilities')
            ->add('comments')
            ->add('paymentMode')
            ->add('joiningDatetime')
        ;
    }
}
