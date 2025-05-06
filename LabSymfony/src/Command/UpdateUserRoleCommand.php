<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateUserRoleCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this->setName('app:update-user-role')
            ->setDescription('Update roles for a user by email.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Оновлення через SQL
        $query = $this->entityManager->createQuery('
        UPDATE App\Entity\User u
        SET u.roles = :roles
        WHERE u.email = :email
    ');

        $query->setParameter('roles', json_encode(['ROLE_MANAGER']));
        $query->setParameter('email', 'manager@gmail.com');
        $query->execute();

        $output->writeln('User role updated to ROLE_MANAGER.');

        return Command::SUCCESS;
    }
}


