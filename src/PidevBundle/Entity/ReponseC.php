<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 4/4/2018
 * Time: 4:48 م
 */

namespace PidevBundle\Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * ReponseC
 *
 * @ORM\Table(name="reponsec", indexes={@ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id_commentaire", columns={"id_commentaire"})})
 * @ORM\Entity(repositoryClass="PidevBundle\Repository\ReponseCRepository")
 */
class ReponseC
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    public $date;
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    public $contenu;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     * })
     */
  public $id_user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @ORM\ManyToOne(targetEntity="CommentaireR")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_commentaire",referencedColumnName="id")
     * })
     */
    public $id_commentaire;
    /**
     * Get id_user
     *
     * @return \PidevBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->id_user;
    }
    /**
     * Set id_user
     *
     * @param \PidevBundle\Entity\User $id_user
     *
     * @return ReponseC
     */
    public function setIdUser(\PidevBundle\Entity\User $id_user = null)
    {
        $this->id_user = $id_user;

        return $this;
    }
    /**
     * Get id_commentaire
     *
     * @return \PidevBundle\Entity\CommentaireR
     */
    public function getIdCommentaire()
    {
        return $this->id_ucommentaire;
    }
    /**
     * Set id_commentaire
     *
     * @param \PidevBundle\Entity\CommentaireR $id_commentaire
     *
     * @return ReponseC
     */
    public function setIdCommentaire(\PidevBundle\Entity\CommentaireR $id_commentaire = null)
    {
        $this->id_commentaire = $id_commentaire;

        return $this;
    }

}