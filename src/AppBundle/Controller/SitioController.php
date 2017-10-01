<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class SitioController extends Controller
  {
       /**
        * @Route("sitio/{pagina}/")
        *
        */

       public function estaticaAction($pagina)
        {
              return $this->render('sitio/'.$pagina.'.html.twig');
        }


}

//return $this->render('default/index.html.twig', ['base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,]);
