<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 4/4/2018
 * Time: 5:11 م
 */

namespace PidevBundle\Controller;
use PidevBundle\Entity\CommentaireR;
use PidevBundle\Entity\ReponseC;
use PidevBundle\Entity\Rubrique_sanitaire;
use PidevBundle\Entity\User;
use PidevBundle\PidevBundle;
use PidevBundle\Repository\CommentaireRepository;
use PidevBundle\Repository\ReponseCRepository;
use PidevBundle\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
class ReponseCController extends Controller
{ public function ajouterreponseAction(Request $request)
{  if ($request->isXmlHttpRequest()) {
    $reponse=new ReponseC();
    $em = $this->getDoctrine()->getManager();
    $id = $request->get('id');
    $objet= $request->get('objet');
    $commentaire=$em->getRepository(CommentaireR::class)->findOneBy(array('id' =>$id));
    $user= $em->getRepository(User::class)->findOneBy(array('id' =>34));
    $reponse->setIdUser($user);
    $reponse->setContenu($objet);
    $reponse->setDate(new \DateTime());
    $reponse->setIdCommentaire($commentaire);
    $em->persist($reponse);
    $em->flush();
    return new JsonResponse(Response::HTTP_OK);


}
    return new Response(Response::HTTP_INTERNAL_SERVER_ERROR);

}
public function afficherreponseAction($id)
{  $repo = $this->getDoctrine()->getRepository(ReponseC::class);
    $reponse = $repo->afficherrep($id);
    return $this->render('PidevBundle:Default:showreponses.html.twig', array("reponses" => $reponse));

}
public function supprimerreponseAction(Request $request)
{  if ($request->isXmlHttpRequest()) {
    $em = $this->getDoctrine()->getManager();
    $idreponse = $request->get('idreponse');
    $user=$request->get('iduser');
    $iduser= $em->getRepository(User::class)->findOneBy(array('id' =>$user));
    $reponse = $em->getRepository(ReponseC::class);
    $reponse->deleteReponse($idreponse,$iduser);

    return new JsonResponse(Response::HTTP_OK);
}
    return new Response(Response::HTTP_INTERNAL_SERVER_ERROR);
}
public function updatereponseAction(Request $request)
{  if ($request->isXmlHttpRequest()) {
    $em = $this->getDoctrine()->getManager();
    $idreponse = $request->get('idreponse');
    $contenu=$request->get('objet');
    $iduser = $request->get('iduser');
    $idcommentaire=$request->get('idcommentaire');
    $user1 = $em->getRepository(User::class)->findOneBy(array('id' => $iduser));
    $commentaire11 = $em->getRepository(CommentaireR::class)->findOneBy(array('id' =>$idcommentaire));
    $datte = new \DateTime();
    $reponse = $em->getRepository(ReponseC::class);
    $reponse->updateReponse($contenu,$datte,$idreponse,$user1,$commentaire11);
    return new JsonResponse(Response::HTTP_OK);
}
    return new Response(Response::HTTP_INTERNAL_SERVER_ERROR);

}

}