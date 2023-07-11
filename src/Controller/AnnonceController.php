<?php
namespace App\Controller;
use App\Entity\Annonce;
use App\Form\AnnonceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnnonceController extends AbstractController
{
    private function generateUniqueFileName() {

        return md5(uniqid());
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    /**
     * @Route("/add", name="addannonce")
     */
  
    public function add(Request $request , EntityManagerInterface $manager) : Response

    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class , $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $annonce = $form->getData();
           $date = new \DateTime('now');
           $annonce->setDatecreation($date);
           $couverture = $annonce->getCouverture();
            if ($couverture != null) {
                $fileName = $this->generateUniqueFileName() . '.' . $couverture->guessExtension();
                $couverture->move($this->getParameter('annonces_directory'), $fileName);
                $annonce->setCouverture($fileName);
            }
            $annonce->setUserId($this->getUser());
           $manager->persist($annonce);
           $manager->flush();
        }
        return $this->render('includes/ajouterannonce.html.twig' ,
        ['form' => $form->createView()]);
    }
        /**
     * @Route("/show/{id}", name="annonce_show")
     */
    public function showdetiel(Annonce $annonce): Response
    { 
        return $this->render('includes/show.html.twig',
        ['annonce' => $annonce]);
    }
          /**
     * @Route("/annonce/edit/{id}", name="annonce_edit")
     */
    public function editannonce(Request $request, $id)
    { 

       $annonce = new Annonce();
       $annonce = $this->getDoctrine()->getRepository(Annonce::class)->find($id);
       $form = $this->createFormBuilder($annonce)
       ->add('title' ,TextType::class)
       ->add('prix' ,TextType::class)
       ->add('description' ,TextType::class)
       ->add('save' , SubmitType::class, array('label' => "Modifier"))
       ->getForm();

       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid())
       {
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('list');
       }
       return $this->render('includes/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("annonce/delete/{id}", name="delete_annonce")
     */
    public function delete(Request $request, $id)
    {
        $annonce = $this->getDoctrine()
        ->getRepository(Annonce::class)
        ->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($annonce);
        $em->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('list');
    }

    
}