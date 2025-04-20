<?php

namespace App\Command;

use App\Entity\Mes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-meses',
    description: 'Carga los meses del año',
)]
class LoadMesesCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        foreach ($meses as $nombre) {
            $mes = new Mes();
            $mes->setNombre($nombre);
            $this->entityManager->persist($mes);
        }

        $this->entityManager->flush();
        $io->success('Todos los meses se han cargado.');

        return Command::SUCCESS;
    }
}
