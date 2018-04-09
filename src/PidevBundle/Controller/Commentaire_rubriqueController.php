<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/3/2018
 * Time: 12:38 م
 */

namespace PidevBundle\Controller;
use PidevBundle\Entity\CommentaireR;
use PidevBundle\Entity\ReponseC;
use PidevBundle\Entity\Rubrique_sanitaire;
use PidevBundle\Entity\User;
use PidevBundle\PidevBundle;
use PidevBundle\Repository\CommentaireRepository;
use PidevBundle\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
class Commentaire_rubriqueController extends Controller
{
    public function affichercommentaireAction($id)
    {
        $repo = $this->getDoctrine()->getRepository(CommentaireR::class);
        $comment = $repo->affichercomm($id);
        return $this->render('PidevBundle:Default:showcomments.html.twig', array("comments" => $comment));
    }

    public function ajoutercommentaireAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $commentaire = New CommentaireR();
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('id_publication');
            $user= $em->getRepository(User::class)->findOneBy(array('id' =>34));
            $rubrique = $em->getRepository(Rubrique_sanitaire::class)->findOneBy(array('id' => $id));
            $commentaire->setIdPublication($rubrique);
            $commentaire->setIdUser($user);
            $commentaire->setDate(new \DateTime());
            $commentaire->setObjet($request->get('objet'));
            $em->persist($commentaire);
           $rubrique->setNbcommentaire($rubrique->getNbcommentaire()+1);
            $em->persist($rubrique);
             $em->flush();

            return new JsonResponse(Response::HTTP_OK);
        }
        return new Response(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function supprimerCommentaireAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {
        $em = $this->getDoctrine()->getManager();
        $id1 = $request->get('id');
    $iduser= $em->getRepository(User::class)->findOneBy(array('id' =>34));
       $commentaire = $em->getRepository(CommentaireR::class);
        $commentaire1=$commentaire->findOneBy(array('id'=>$id1));
        $reponse=$em->getRepository(ReponseC::class)->deletelesreponses($commentaire1);
        $rubrique=$commentaire1->getIdPublication();
        $commentaire->deleteCommentaire($id1,$iduser);
        $rubrique->setNbcommentaire($rubrique->getNbcommentaire()-1);
        $em->persist($rubrique);
        $em->flush();
        return new JsonResponse(Response::HTTP_ACCEPTED);
    }
        return new Response(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function updateCommentaireAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $id1 = $request->get('id');
            $objet = $request->get('objet');
            $id2=$request->get('id1');
            $user = $em->getRepository(User::class)->findOneBy(array('id' => $id2));
            $datte = new \DateTime();
            $commentaire = $em->getRepository(CommentaireR::class);
            $commentaire->updateCommentaire($objet,$datte,$id1,$user);
            return new JsonResponse(Response::HTTP_OK);
        }
        return new Response(Response::HTTP_INTERNAL_SERVER_ERROR);
    }}





















