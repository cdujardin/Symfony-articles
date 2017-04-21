<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=5, minMessage="Le titre doit avoir au moins 5 caractères !")
     */
    protected $title;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Auteur")
    **/
    protected $auteur;

    public function getId(){
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
        $auteur -> addArticle($this);
    }




}
