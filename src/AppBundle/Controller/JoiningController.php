<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Joining;
use AppBundle\Entity\Payment\Payment;
use AppBundle\Entity\Payment\MembershipPayment;
use AppBundle\Form\JoiningType;

class JoiningController extends Controller
{
    /**
     * @Route("/", name="joining_index", host="%joining_domain%")
     */
    public function indexAction(Request $request)
    {
        $joining = new Joining();
        $form = $this->createForm(JoiningType::class, $joining);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Adhérer',
            'attr'  => array('class' => 'btn btn-default pull-right'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($joining);

            $payment = $this->createPayment($joining);
            $joining->addPayment($payment);

            $entityManager->persist($joining);
            $entityManager->persist($payment);
            $entityManager->flush();

            if ($joining->getPaymentMode() == Joining::PAYMENT_MODE_ONLINE) {
                return $this->redirectToRoute('payment_pay', array('id' => $payment->getId()));
            } else {
                return $this->redirectToRoute('joining_success', array('id' => $joining->getId()));
            }
        }

        return $this->render('joining/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/joining/{id}/success", name="joining_success", host="%joining_domain%")
     * @ParamConverter("joining", class="AppBundle:Joining")
     */
    public function successAction(Joining $joining)
    {
        return $this->render('joining/success.html.twig', [
            'joining' => $joining,
        ]);
    }

    /**
     * @return MembershipPayment
     */
    protected function createPayment(Joining $joining)
    {
        $payment = new MembershipPayment($joining);
        $payment->setAmount($joining->getMembershipFee()->getCost())
            ->setStatus(Payment::STATUS_NEW)
            ->setDrawer($joining->getEmail())
            // ->setRecipient($adherent)
            ->setDate(new \DateTime('now'))
            ->setReferenceIdentifierPrefix(
                sprintf("%s %s %s",
                    $joining->getReference(),
                    $joining->getLastname(),
                    $joining->getFirstname()
                )
            )
        ;

        if ($joining->getPaymentMode() == Joining::PAYMENT_MODE_ONLINE) {
            $payment->setMethod(Payment::METHOD_CREDIT_CARD);
        } else {
            $payment->setMethod(Payment::METHOD_CHEQUE);
        }

        return $payment;
    }
}
