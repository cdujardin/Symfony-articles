<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Auteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="firstname", type="string", length=255)
     * @Assert\NotBlank
     */
   protected $firstname;

   /**
    * @ORM\Column(name="name", type="string", length=255)
    * @Assert\NotBlank
    */
    protected $name;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="auteur")
    **/
  protected $article;

  public function __construct(){
      $this->article = new ArrayCollection();
  }

  public function getId()    {
      return $this->id;
  }


  public function getFirstName()    {
      return $this->firstname;
  }

  public function setFirstName($firstname)    {
      $this->firstname = $firstname;
  }


  public function getName()    {
      return $this->name;
  }

  public function setName($name)    {
      $this->name = $name;
  }


  public function getArticle() {
      return $this->article;
  }

  public function setArticle($article) {
      $this->article = $article;

  }

  public function addArticle($article){
      $this->article->add($article);
  }
  public function getFullName(){
     return $this->getFirstName().' '.$this->getName();
  }

}
