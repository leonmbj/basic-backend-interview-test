<?php

namespace Neos\NeosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // return $this->render('NeosBundle:Default:index.html.twig');
        $response = new JsonResponse(array('Hello'=>'World!'));
    	return $response;
    }

}
