<?php

namespace PidevBundle\Controller;

use PidevBundle\Form\ajoutRubriqueForm;
use PidevBundle\Entity\Rubrique_sanitaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use PidevBundle\Repository\RubriqueRepository;
class Rubrique_sanitaireController extends Controller
{    function ajouterRubriqueAction(Request $request)
{          $rubrique=new Rubrique_sanitaire();
            $form=$this->createForm(ajoutRubriqueForm::class,$rubrique);
            $form->handleRequest($request);
    if($form->isSubmitted())
    {
        /**
         * @var UploadedFile $file
         */
        $file=$rubrique->getImage();
        $file1 = $rubrique->getBrochure();

        $fileName1 = $this->generateUniqueFileName().'.'.$file1->guessExtension();
        $fileName=md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->getParameter('image_directory'),$fileName);
        $file1->move(
            $this->getParameter('image_directory'),
            $fileName1
        );

        $rubrique->setBrochure($fileName1);
        $rubrique->setImage($fileName);
        $em=$this->getDoctrine()->getManager();
        $em->persist($rubrique);
        $em->flush();
        return $this->redirectToRoute('afficher_rubrique');
    }
    return $this->render('PidevBundle:Default:ajoutRubrique.html.twig',array('form'=>$form->createview()));

}
    public function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    function afficheRubriqueAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rubrique = $em->getRepository(Rubrique_sanitaire::class)->afficherRubriqueSanitaire();
        return $this->render('PidevBundle:Default:showRubrique.html.twig', array("rubriques" => $rubrique));

    }

}
