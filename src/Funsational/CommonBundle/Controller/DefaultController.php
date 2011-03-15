<?php

namespace Funsational\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FunsationalCommonBundle:Default:index.html.twig');
    }
}
