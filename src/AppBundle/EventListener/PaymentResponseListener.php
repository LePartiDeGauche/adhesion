<?php

namespace AppBundle\EventListener;

use Lexik\Bundle\PayboxBundle\Event\PayboxResponseEvent;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Payment\Payment;
use Psr\Log\LoggerInterface;

class PaymentResponseListener
{
    private $em;

    private $logger;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function onPaymentIpnResponse(PayboxResponseEvent $event)
    {
        if ($event->isVerified()) {
            $this->logger->info('IPN Response: event verified');
            $data = $event->getData();
            $ref = explode(' ', $data['Ref']);
            $payment_id = (int) $ref[count($ref) - 1];

            $payment = $this->em->getRepository('AppBundle:Payment\Payment')->findOneById($payment_id);
            $payment->setPaymentIPN($data);

            if ($data['Erreur'] == 0000) {
                $payment->setStatus(Payment::STATUS_BANKED);
            } else {
                $payment->setStatus(Payment::STATUS_REFUSED);
            }
            $this->em->persist($payment);
            $this->em->flush();
        } else {
            $this->logger->error('IPN Response: event not verified');
        }
    }
}
