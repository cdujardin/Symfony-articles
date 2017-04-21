<?php

namespace AppBundle\Command;

use AppBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddAuthorCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:author:add')
            ->setDescription('Add an author')
            ->addArgument('name', InputArgument::REQUIRED, 'Nom de l\'auteur')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        $author = new Author();
        $author->setName($name);

        $this->getContainer()->get('app.manager.author')->save($author);

        $output->writeln('<bg=green;fg=white>Auteur créé avec succès</>');
    }
}
