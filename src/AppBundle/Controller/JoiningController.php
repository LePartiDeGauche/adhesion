<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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


        if ($form->isSubmitted() && $form->isValid()) {

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('joining/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
