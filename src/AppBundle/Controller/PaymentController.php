<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Payment\Payment;
use AppBundle\Entity\Payment\MembershipPayment;
use AppBundle\Entity\Payment\DonationPayment;

/**
 * Payment controller.
 *
 * @Route("/payment")
 */
class PaymentController extends Controller
{
    /**
     * Online transaction with paybox.
     *
     * @Route("/{id}", name="payment_pay")
     *
     * @ParamConverter("payment", class="AppBundle:Payment\Payment")
     */
    public function payAction(Payment $payment)
    {
        if (($payment->getStatus() == Payment::STATUS_NEW || $payment->getStatus() == Payment::STATUS_PENDING) &&
                $payment->getMethod() == Payment::METHOD_CREDIT_CARD) {

            $payment->setStatus(Payment::STATUS_PENDING);
            $cmdid = $payment->getReferenceIdentifierPrefix();
            $paybox = $this->get('lexik_paybox.request_handler');
            $paybox->setParameters(array(
                'PBX_CMD' => $cmdid,
                'PBX_DEVISE' => '978',
                'PBX_PORTEUR' => $payment->getDrawer(),
                'PBX_RETOUR' => 'Mt:M;Ref:R;Auto:A;Erreur:E',
                'PBX_TOTAL' => round(100 * $payment->getAmount()),
                // 'PBX_TYPEPAIEMENT' => 'CARTE',
                // 'PBX_TYPECARTE' => 'CB',
                'PBX_EFFECTUE' => $this->generateUrl('payment_paybox_return',
                    array('status' => 'success'), UrlGeneratorInterface::ABSOLUTE_URL),
                'PBX_REFUSE' => $this->generateUrl('payment_paybox_return',
                    array('status' => 'denied'), UrlGeneratorInterface::ABSOLUTE_URL),
                'PBX_ANNULE' => $this->generateUrl('payment_paybox_return',
                    array('status' => 'canceled'), UrlGeneratorInterface::ABSOLUTE_URL),
                'PBX_ATTENTE' => $this->generateUrl('payment_paybox_return',
                    array('status' => 'pending'), UrlGeneratorInterface::ABSOLUTE_URL),
                'PBX_RUF1' => 'POST',
                'PBX_REPONDRE_A' => $this->generateUrl('lexik_paybox_ipn',
                    array('time' => time()), UrlGeneratorInterface::ABSOLUTE_URL),
            ));

            $this->getDoctrine()->getManager()->persist($payment);
            $this->getDoctrine()->getManager()->flush();

            $view = ($payment instanceof DonationPayment)
                ? 'payment/pay_donation.html.twig'
                : 'payment/pay.html.twig';

            return $this->render($view, array(
                'url' => $paybox->getUrl(),
                'form' => $paybox->getForm()->createView(),
                'payment' => $payment,
                'paybox_enabled' => true, // TODO: set a parameter to enable/disable paybox payment
            ));
        } else {
            throw $this->createNotFoundException('Payment not found');
        }


    }

    /**
     * Online transaction with paybox.
     *
     * @Route("/return/{status}", name="payment_paybox_return")
     */
    public function returnAction($status, Request $request)
    {
        return $this->render(
            'payment/return.html.twig',
            array(
                'status' => $status,
                'parameters' => $request->query,
            )
        );
    }
}
