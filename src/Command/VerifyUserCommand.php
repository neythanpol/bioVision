<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\SecurityBundle\Security; // Clase actualizada

#[AsCommand(
    name: 'app:verify-user',
    description: 'Verifica usuarios del sistema'
)]
class VerifyUserCommand extends Command
{
    public function __construct(
        private Security $security, // Usamos la clase correcta
        private EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        // Mostrará todos los usuarios aunque no haya sesión activa
        $users = $this->em->getRepository('App\Entity\Usuario')->findAll();
        
        $io->section('Todos los usuarios en la base de datos');
        foreach ($users as $user) {
            $this->displayUserData($io, $user);
            $io->newLine();
        }
        
        return Command::SUCCESS;
    }
    
    private function displayUserData(SymfonyStyle $io, $user): void
    {
        $io->table(
            ['Campo', 'Valor'],
            [
                ['ID', $user->getId()],
                ['Username', $user->getUserIdentifier()],
                ['Email', $user->getEmail()],
                ['Verificado', $user->isVerified() ? '✅ Sí' : '❌ No'],
                ['Clase', get_class($user)]
            ]
        );
    }
}