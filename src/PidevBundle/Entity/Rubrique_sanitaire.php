<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25/3/2018
 * Time: 7:30 م
 */

namespace PidevBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Rubrique
 ** @ORM\Table(name="rubrique_sanitaire")
 * @ORM\Entity(repositoryClass="PidevBundle\Repository\RubriqueRepository")
 */

class Rubrique_sanitaire
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    public $date;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    public $contenu;


    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $brochure;

    public function getBrochure()
    {
        return $this->brochure;
    }

    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }
    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @var string
     * @Assert\NotBlank(message=" plz enter an image")
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=255)
     */
    public $image;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    public $titre;

    /**
     * @return int
     */
    public function getNbcommentaire()
    {
        return $this->nbcommentaire;
    }

    /**
     * @param int $nbcommentaire
     */
    public function setNbcommentaire($nbcommentaire)
    {
        $this->nbcommentaire = $nbcommentaire;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="nbcommentaire", type="integer")

     */
    private $nbcommentaire=0;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }



}