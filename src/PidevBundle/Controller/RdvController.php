<?php

namespace PidevBundle\Controller;
use DoctrineExtensions\Query\Mysql\DateAdd;
use PidevBundle\Entity\Rdv;
use PidevBundle\Entity\User;
use PidevBundle\Form\rdvbyserviceForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PidevBundle\Repository\RdvRepository;
use PidevBundle\Repository\UserRepository;

class RdvController extends Controller
{

    function AffichagefournisseurAction(Request $request)
    {$user = new User();
        $form = $this->createForm(rdvbyserviceForm::class,$user);

        $form->handleRequest($request);
        if($form->isSubmitted())
        {
           $field = $user->getTypeService();
            $field1 = $user->getAdresse();
            $users = $this->getDoctrine()
                ->getRepository(User::class)->findfournisseur($field, $field1);}
                else
                {  $users = $this->getDoctrine()
            ->getRepository(Rdv::class)-> afficherfournisseur();}


        return $this->render('PidevBundle:Default:rdv1.html.twig',
            array('users' => $users,'f' => $form->createView()));

        }

    function afficherrdvpurmembreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rdv = $em->getRepository(Rdv::class)->afficherRdvArctionpourmembre(34);
        return $this->render('PidevBundle:Default:calendrier.html.twig', array("rdvs" => $rdv));


    }

    function ajoutRdvAction(Request $request,$id)
    {
       if ($request->isXmlHttpRequest()) {

           $rdv = new Rdv();
           $id1 = $request->get('id_fourni');
           $em = $this->getDoctrine()->getManager();
           $date = $request->get('datte');
           $r=$em->getRepository(Rdv::class)->afficherdvparjourDQL($id1);
          $date1= new \DateTime("$date");
           $date2=strtotime(date_format($date1,"Y/m/d H:i:s"));
           $trouve=0;
           foreach( $r as $item2 )
           {  if(strtotime(date_format($item2->getDateRdv(),"Y/m/d H:i:s"))==$date2)
           {
               $trouve=1;
               break;
           }
           }

               if($trouve==0)
               {

           $rdv->setTypeConsultation($request->get('type_consultation'));
           $rdv->setPrixConsultation($request->get('prix'));
           $user = $em->getRepository(User::class)->findOneBy(array('id' => $id1));
           $rdv->setIdFournisseur($user);

           $rdv->setDateRdv(new \DateTime("$date"));
           $email = $request->get('email');
           $user1 = $em->getRepository(User::class)->findOneBy(array('email' => $email));
           $rdv->setIdMembre($user1);
           $em->persist($rdv);
           $em->flush();



                   return new JsonResponse(Response::HTTP_OK);
               }
           else{
               return new JsonResponse(Response::HTTP_FORBIDDEN);
           }



           }

            $em1 = $this->getDoctrine()->getManager();
            $u = $em1->getRepository("PidevBundle:User")->find($id);
            return $this->render('PidevBundle:Default:step2.html.twig', array(
                'u' => $u));

    }
    public function compter1Action()
    {
        $nb=0;
        $total=0;
        $rdv=[];
        $rdv1=[];
        $rdv2=[];
        $em = $this->getDoctrine()->getRepository(Rdv::class);
        $r=$em->compterrdvparjourDQL(32);
        foreach( $r as $i )
        { if(date_format($i->getDateRdv(),"Y/m/d")==date("Y/m/d"))
            {
              $nb++  ;


              }
              }
         $c=$em->compterrdvpour2m1DQL(32);
        $date=date("Y/m/d", strtotime("+1 day"));
        foreach ($c as $item)
        {  if(date_format($item->getDateRdv(),"Y/m/d")==$date)
        {
          $total++;
        }
        }
        $total1=0;
        $g=$em->compterrdvpourlasemaineDQL(32);
        $date2=strtotime(date("Y/m/d"));
        foreach ($g as $item1)
        {  if($date2-strtotime(date_format($item1->getDateRdv(),"Y/m/d"))<=7)
        {
            $total1++;
        }
        }
        $b=$em->afficherdvparjourDQL(32);
        foreach( $b as $item2 )
        { if(date_format($item2->getDateRdv(),"Y/m/d")==date("Y/m/d"))
        {
            $rdv[]=$item2 ;



        }
        }
        foreach( $b as $item3 )
        { if(date_format($item3->getDateRdv(),"Y/m/d")==$date)
        {
            $rdv1[]=$item3 ;



        }
        }
        foreach( $b as $item4 )
        {    if($date2-strtotime(date_format($item4->getDateRdv(),"Y/m/d"))<=7)
            {
            $rdv2[]=$item4;


        }
        }

        return $this->render('PidevBundle:Default:rendez_vous_four_f.html.twig',array("nombre1" => $nb,"nombre2"=>$total,"nombre3"=>$total1,"rdvs1"=>$rdv,"rdvs2"=>$rdv1,"rdvs3"=>$rdv2));




    }


    function deleteAction( Request $request)
    {  if ($request->isXmlHttpRequest()) {
        $id=($request->get('id'));
        $em = $this->getDoctrine()->getManager();
        $rdv = $em->getRepository('PidevBundle:Rdv')->find($id);
        $em->remove($rdv);
        $em->flush();}
        return $this->redirectToRoute('afficher');
    }
    function updateAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $id1 = $request->get('id_fourni');
            $id=($request->get('id'));
            $r=$em->getRepository(Rdv::class)->afficherdvparjourDQL($id1);
            $datte = $request->get('datte');
            $date1= new \DateTime("$datte");
            $date2=strtotime(date_format($date1,"Y/m/d H:i:s"));
            $trouve=0;
            foreach( $r as $item2 )
            {  if(strtotime(date_format($item2->getDateRdv(),"Y/m/d H:i:s"))==$date2)
            {
                $trouve=1;
                break;
            }
            }
            if($trouve==0)
            {
            $rdv = $em->getRepository('PidevBundle:Rdv')->update($id,$date1);
            return new JsonResponse(Response::HTTP_OK);

        }

    }
        return new JsonResponse(Response::HTTP_BAD_REQUEST);}
}





