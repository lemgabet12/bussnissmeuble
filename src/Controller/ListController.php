<?php
namespace App\Controller;
use App\Entity\Annonce;
use App\Entity\User;
use App\Controller\AnnonceController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
   /**
     * @Route("/list", name="list")
     */
    public function add()
    {
       
        $annonces = $this->getDoctrine()->getRepository(Annonce::class)->findBy([],['datecreation' => 'desc']);
        return $this->render(
            'includes/listannonce.html.twig',
            ['annonces' => $annonces]
        );
    }

}