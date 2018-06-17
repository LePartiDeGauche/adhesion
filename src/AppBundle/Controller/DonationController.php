<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Donation;
use AppBundle\Entity\Payment\Payment;
use AppBundle\Entity\Payment\DonationPayment;
use AppBundle\Form\DonationType;


class DonationController extends Controller
{
    /**
     * @Route("/", name="donation_index", host="%donation_domain%")
     */
    public function indexAction(Request $request)
    {
        $donation = new Donation();
        $form = $this->createForm(DonationType::class, $donation);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Faire un don',
            'attr'  => array('class' => 'btn btn-default pull-right'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $payment = $this->createPayment($donation);
            $donation->addPayment($payment);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($donation);
            $entityManager->persist($payment);
            $entityManager->flush();

            if ($donation->getPaymentMode() == Donation::PAYMENT_MODE_ONLINE) {
                return $this->redirectToRoute('payment_pay', array('id' => $payment->getId()));
            } else {
                return $this->redirectToRoute('donation_success', array('id' => $donation->getId()));
            }
        }

        return $this->render('donation/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/donation/{id}/success", name="donation_success", host="%donation_domain%")
     * @ParamConverter("donation", class="AppBundle:Donation")
     */
    public function successAction(Donation $donation)
    {
        return $this->render('donation/success.html.twig', [
            'donation' => $donation,
        ]);
    }

    /**
     * @return MembershipPayment
     */
    protected function createPayment(Donation $donation)
    {
        $payment = new DonationPayment($donation);
        $payment->setAmount($donation->getAmount())
            ->setStatus(Payment::STATUS_NEW)
            ->setDrawer($donation->getEmail())
            // ->setRecipient($adherent)
            ->setDate(new \DateTime('now'))
            ->setReferenceIdentifierPrefix(
                sprintf("%s %s %s",
                    $donation->getReference(),
                    $donation->getLastname(),
                    $donation->getFirstname()
                )
            )
        ;

        if ($donation->getPaymentMode() == Donation::PAYMENT_MODE_ONLINE) {
            $payment->setMethod(Payment::METHOD_CREDIT_CARD);
        } else {
            $payment->setMethod(Payment::METHOD_CHEQUE);
        }

        return $payment;
    }
}
