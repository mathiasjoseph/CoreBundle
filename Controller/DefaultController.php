<?php

namespace Miky\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MikyCoreBundle:Default:index.html.twig');
    }
}
