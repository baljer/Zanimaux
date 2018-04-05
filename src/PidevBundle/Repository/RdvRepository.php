<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19/3/2018
 * Time: 9:37 م
 */

namespace PidevBundle\Repository;

/**
 * RdvRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class RdvRepository extends \Doctrine\ORM\EntityRepository
{
    public function findfournisseur($field,$field1){

        $q=$this->getEntityManager()
            ->createQuery("SELECT u FROM PidevBundle:User u WHERE u.type_service = :field AND u.adresse = :field1")
            ->setParameter('field',$field)
           ->setParameter('field1',$field1);
        return $q->getResult();

    }


    public function afficherRdvArctionpourmembre($id)
    {
        $q = $this->getEntityManager()
            ->createQuery('select r from PidevBundle:Rdv r  where r.idMembre=:id ORDER BY r.idr')
            ->setParameter('id',$id);

        return $q->getResult();
    }

 public function compterrdvparjourDQL($idFournisseur)
{
       $q = $this->getEntityManager()
        ->createQuery('select r FROM PidevBundle:Rdv r WHERE r.idFournisseur=:idFournisseur')
        ->setParameter('idFournisseur',$idFournisseur);
    return $q->getResult();




}
    public function compterrdvpour2m1DQL($id)
    {
        $q = $this->getEntityManager()
            ->createQuery('SELECT r from PidevBundle:Rdv r WHERE r.idFournisseur=:id' )
            ->setParameter('id',$id);

        return $q->getResult();
    }
    public function compterrdvpourlasemaineDQL($id)
    {
        $q = $this->getEntityManager()
            ->createQuery('SELECT r from PidevBundle:Rdv r where r.idFournisseur=:id' )
            ->setParameter('id',$id);

        return $q->getResult();
    }
    public function afficherdvparjourDQL($id)
    {
        $q = $this->getEntityManager()
            ->createQuery('SELECT r from PidevBundle:Rdv r where r.idFournisseur=:id')
            ->setParameter('id',$id);

        return $q->getResult();
    }
    public function update($id,$dateRdv)
    {    $q=$this->getEntityManager()->createQuery("UPDATE PidevBundle:Rdv r SET r.dateRdv=:dateRdv WHERE r.idr=:id")
        ->setParameter('dateRdv',$dateRdv)
        ->setParameter('id',$id);

        return $q->getResult();

    }

}