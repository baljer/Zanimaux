<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/3/2018
 * Time: 12:16 م
 */

namespace PidevBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * CommentaireR
 *
 * @ORM\Table(name="commentairer")
 * @ORM\Entity(repositoryClass="PidevBundle\Repository\CommentaireRepository")
 */
class CommentaireR
{
    /**
 * @var int
 *
 * @ORM\Column(name="id", type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="Rubrique_sanitaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_publication",referencedColumnName="id")
     * })
     */
    public $id_publication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    public $date;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=255)
     */
    public $objet;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser",referencedColumnName="id")
     * })
     */
    private $iduser;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CommentaireR
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return CommentaireR
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
    }
    /**
     * Set id_publication
     *
     * @param \PidevBundle\Entity\Rubrique_sanitaire $id_publication
     *
     * @return CommentaireR
     */
    public function setIdPublication(\PidevBundle\Entity\Rubrique_sanitaire $id_publication = null)
    {
        $this->id_publication = $id_publication;

        return $this;
    }

    /**
     * Get id_publication
     *
     * @return \PidevBundle\Entity\Rubrique_sanitaire
     */
    public function getIdPublication()
    {
        return $this->id_publication;
    }
    /**
     * Get iduser
     *
     * @return \PidevBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->iduser;
    }
    /**
     * Set iduser
     *
     * @param \PidevBundle\Entity\User $iduser
     *
     * @return CommentaireR
     */
    public function setIdUser(\PidevBundle\Entity\User $iduser = null)
    {
        $this->iduser = $iduser;

        return $this;
    }

}