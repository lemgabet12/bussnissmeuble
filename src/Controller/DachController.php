<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DachController extends AbstractController
{
    /**
     * @Route("/mydach", name="mydach")
     */
  
    public function mydach()

    {
        return $this->render('includes/mydash.html.twig');
    }

   
}