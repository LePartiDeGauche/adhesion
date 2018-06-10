<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        return $this->render('joining/index.html.twig', [
            'controller_name' => 'JoiningController',
        ]);
    }
}
