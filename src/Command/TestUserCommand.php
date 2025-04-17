<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(
    name: 'app:test-user',
    description: 'Prueba la información de un usuario específico'
)]
class TestUserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em // Inyectamos el EntityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('user-id', InputArgument::OPTIONAL, 'ID del usuario a consultar', 1)
            ->setHelp('Este comando muestra información detallada de un usuario específico');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $userId = $input->getArgument('user-id');
        
        $user = $this->em->getRepository('App\Entity\Usuario')->find($userId);
        
        if (!$user) {
            $io->error(sprintf('Usuario con ID %d no encontrado', $userId));
            return Command::FAILURE;
        }

        $io->title(sprintf('Información del Usuario ID %d', $userId));
        $io->table(
            ['Campo', 'Valor'],
            [
                ['ID', $user->getId()],
                ['Username', $user->getUsername()],
                ['Email', $user->getEmail()],
                ['Verificado', $user->isVerified() ? '✅ Sí' : '❌ No'],
                ['Roles', implode(', ', $user->getRoles())]
            ]
        );

        return Command::SUCCESS;
    }
}