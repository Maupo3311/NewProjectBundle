<?php

namespace NewProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package NewProjectBundle\Controller
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return new Response('SUCCESS!');
    }
}
