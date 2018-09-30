<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class JoiningAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('pdf', $this->getRouterIdParameter().'/pdf');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            // ->add('isRenewed')
            ->add('lastname')
            ->add('firstname')
            // ->add('gender')
            // ->add('address')
            // ->add('postalCode')
            // ->add('city')
            // ->add('country')
            // ->add('department')
            // ->add('localComitee')
            // ->add('email')
            // ->add('birthdate')
            // ->add('phoneNumber')
            // ->add('mobilephone')
            // ->add('job')
            // ->add('electiveMandate')
            // ->add('mandateLocation')
            // ->add('tradeUnionCommitment')
            // ->add('associativeCommitment')
            // ->add('responsabilities')
            // ->add('comments')
            ->add('paymentMode')
            // ->add('joiningDatetime')
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
            ->addIdentifier('lastname')
            ->addIdentifier('firstname')
            ->add('gender')
            ->add('birthdate', null, array(
                'format' => 'd/m/Y',
            ))
            ->add('city')
            ->add('department')
            ->add('isRenewed')
            ->add('paymentMode')
            ->add('membershipFee.cost')
            ->add('joiningDatetime', null, array(
                'format' => 'd/m/Y',
            ))
            ->add('email')
            ->add('phoneNumber')
            ->add('mobilephone')
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
            ->add('membershipFee.cost')
            ->add('joiningDatetime')
        ;
    }

    public function getExportFormats()
    {
        $formats = parent::getExportFormats();
        return array_merge($formats, array('pdf'));
    }
}
