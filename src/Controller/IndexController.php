<?php
namespace App\Controller;
use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Knp\Component\Pager\PaginatorInterface; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/" , name="home")
     */
    public function home()

    {
        $annonces= $this->getDoctrine()->getRepository(Annonce::class) ->findAll();
        return $this->render('index.html.twig',
        ['annonces' => $annonces]);
        //return $this->render('index.html.twig');
    }

   /**
     * @Route("/annonce/{id}", name="annonce_detiel")
     * @param Annonce $annonce
     * @return Response
     */
  
     public function showdeteil($id)

     {
        $annonce = $this->getDoctrine()->getRepository(Annonce::class)->find($id);
         return $this->render("includes/detiel.html.twig", array("annonce" => $annonce));
     }
   
      /**
     * @Route("/all" , name="all_annonce")
     */
     public function allannonce(Request $request,  PaginatorInterface $Paginator) :Response

     {

        
        $annonces = $this->getDoctrine()->getRepository(Annonce::class)->findBy([],['datecreation' => 'desc']);
        $annonces = $Paginator->paginate(
            $annonces,
            $request->query->getInt('page', 1),
            5

        );
        
         return $this->render('includes/allannonce.html.twig',
         ['annonces' => $annonces]);
         //return $this->render('index.html.twig');
     }
  
   

   
}