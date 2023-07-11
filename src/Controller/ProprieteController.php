<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProprieteController extends AbstractController
{
    /**
     * @Route("/propiete", name="propiete")
     */
  
    public function propiete()

    {
        return $this->render('profil/mypropiete.html.twig');
    }

   
}