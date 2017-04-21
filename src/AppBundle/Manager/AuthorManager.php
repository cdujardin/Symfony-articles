<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AuthorManager
{
    private $em;
    private $session;

    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function save(Author $author, $flush = true)
    {
        $this->em->persist($author);

        if (true === $flush) {
            $this->em->flush();
        }

        $this->session->getFlashBag()->add('success', 'Author enregistré avec succès !');
    }

    public function delete(Author $author)
    {
        $this->em->remove($author);
        $this->em->flush();

        $this->session->getFlashBag()->add('success', 'Author modifié avec succès !');
    }
}
