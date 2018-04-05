<?php

namespace PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;
/**
 * Rdv
 *
 * @ORM\Table(name="rdv", indexes={@ORM\Index(name="id_fournisseur", columns={"id_fournisseur"}), @ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity(repositoryClass="PidevBundle\Repository\RdvRepository")
 * Notifiable(name="rdv")
 */
class Rdv implements NotifiableInterface

{
    /**
     * @var integer
     *
     * @ORM\Column(name="idr", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $idr;

    /**
     * @ORM\ManyToOne(targetEntity="PidevBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     * })
     */
   public $idMembre;

    /**
     * @ORM\ManyToOne(targetEntity="PidevBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fournisseur", referencedColumnName="id")
     * })
     */
    public $idFournisseur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rdv", type="datetime")
     */
    public $dateRdv;

    /**
     * @var string
     *
     * @ORM\Column(name="type_consultation", type="string", length=255)
     */
    private $typeConsultation;
    /**
     * @var float
     *
     * @ORM\Column(name="prix_consultation", type="float")
     */
    private $prixConsultation;

    /**
     * Get prixConsultation
     *
     * @return float
     */
    public function getPrixConsultation()
    {
        return $this->prixConsultation;
    }

    /**
     * Set prixConsultation
     *
     * @param float $typeConsultation
     *
     * @return Rdv
     */
    public function setPrixConsultation($prixConsultation)
    {
        $this->prixConsultation = $prixConsultation;
    }

    /**
     * Get dateRdv
     *
     * @return \DateTime
     */
    public function getDateRdv()
    {
        return $this->dateRdv;
    }

    /**
     * Set dateRdv
     *
     * @param \DateTime $dateRdv
     *
     * @return Rdv
     */
    public function setDateRdv($dateRdv)
    {
        $this->dateRdv = $dateRdv;
    }

    /**
     * Get typeConsultation
     *
     * @return string
     */
    public function getTypeConsultation()
    {
        return $this->typeConsultation;
    }

    /**
     * Set typeConsultation
     *
     * @param string $typeConsultation
     *
     * @return Rdv
     */
    public function setTypeConsultation($typeConsultation)
    {
        $this->typeConsultation = $typeConsultation;
    }

    /**
     * Get idFournisseur
     *
     * @return \PidevBundle\Entity\User
     */
    public function getIdFournisseur()
    {
        return $this->idFournisseur;
    }


    /**
     * Set idMembre
     *
     * @param \PidevBundle\Entity\User $idMembre
     *
     * @return Rdv
     */
    public function setIdMembre(\PidevBundle\Entity\User $idMembre= null)
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    /**
     * Get idFournisseur
     *
     * @return \PidevBundle\Entity\User
     */
    public function getIdMembre()
    {
        return $this->idFournisseur;
    }
    /**
     * Set idFournisseur
     *
     * @param \PidevBundle\Entity\User $idFournisseur
     *
     * @return Rdv
     */
    public function setIdFournisseur(\PidevBundle\Entity\User $idFournisseur= null)
    {
        $this->idFournisseur= $idFournisseur;

        return $this;
    }




}
