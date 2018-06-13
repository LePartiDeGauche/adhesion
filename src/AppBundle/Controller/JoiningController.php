<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Joining;
use AppBundle\Form\JoiningType;

/**
 * @Route("/joining")
 */
class JoiningController extends Controller
{
    /**
     * @Route("/", name="joining_index")
     */
    public function indexAction(Request $request)
    {
        $joining = new Joining();
        $form = $this->createForm(JoiningType::class, $joining);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Create',
            'attr'  => array('class' => 'btn btn-default pull-right'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($joining);
            $entityManager->flush();

            if ($joining->getPaymentMode() == Joining::PAYMENT_MODE_ONLINE) {
                return $this->redirectToRoute('joining_payment', $joining);
            } else {
                return $this->redirectToRoute('joining_success', $joining);
            }
        }

        return $this->render('joining/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/payment", name="joining_payment")
     * @ParamConverter("joining", class="AppBundle:Joining")
     */
    public function paymentAction(Joining $joining)
    {
        return $this->render('joining/payment.html.twig', [
            'joining' => $joining,
        ]);
    }

    /**
     * @Route("/{id}/success", name="joining_success")
     * @ParamConverter("joining", class="AppBundle:Joining")
     */
    public function successAction(Joining $joining)
    {
        return $this->render('joining/success.html.twig', [
            'joining' => $joining,
        ]);
    }
}
