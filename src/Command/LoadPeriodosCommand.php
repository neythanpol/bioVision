<?php

namespace App\Command;

use App\Entity\Mes;
use App\Entity\Periodo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-periodos',
    description: 'Carga los periodos de las aves',
)]
class LoadPeriodosCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $periodos = [
            'Residente' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
            'Invernante' => [12, 1, 2, 3],
            'Estival' => [6, 7, 8, 9]
        ];

        foreach ($periodos as $tipo => $mesesIds) {
            $periodo = new Periodo();
            $periodo->setTipo($tipo);

            foreach ($mesesIds as $mesId) {
                $mes = $this->entityManager->getRepository(Mes::class)->find($mesId);
                $periodo->addMes($mes);
            }

            $this->entityManager->persist($periodo);
        }

        $this->entityManager->flush();
        $io->success('Todos los tipos de periodo se han cargado.');

        return Command::SUCCESS;
    }
}
