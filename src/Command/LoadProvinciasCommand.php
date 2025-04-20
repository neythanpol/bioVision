<?php

namespace App\Command;

use App\Entity\Provincia;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-provincias',
    description: 'Carga las provincias españolas',
)]
class LoadProvinciasCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager) 
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $provincias = [
            ['01', 'Álava'],
            ['02', 'Albacete'],
            ['03', 'Alicante'],
            ['04', 'Almería'],
            ['05', 'Ávila'],
            ['06', 'Badajoz'],
            ['07', 'Baleares'],
            ['08', 'Barcelona'],
            ['09', 'Burgos'],
            ['10', 'Cáceres'],
            ['11', 'Cádiz'],
            ['12', 'Castellón'],
            ['13', 'Ciudad Real'],
            ['14', 'Córdoba'],
            ['15', 'La Coruña'],
            ['16', 'Cuenca'],
            ['17', 'Gerona'],
            ['18', 'Granada'],
            ['19', 'Guadalajara'],
            ['20', 'Guipúzcoa'],
            ['21', 'Huelva'],
            ['22', 'Huesca'],
            ['23', 'Jaén'],
            ['24', 'León'],
            ['25', 'Lérida'],
            ['26', 'La Rioja'],
            ['27', 'Lugo'],
            ['28', 'Madrid'],
            ['29', 'Málaga'],
            ['30', 'Murcia'],
            ['31', 'Navarra'],
            ['32', 'Orense'],
            ['33', 'Asturias'],
            ['34', 'Palencia'],
            ['35', 'Las Palmas de Gran Canaria'],
            ['36', 'Pontevedra'],
            ['37', 'Salamanca'],
            ['38', 'Santa Cruz de Tenerife'],
            ['39', 'Cantabria'],
            ['40', 'Segovia'],
            ['41', 'Sevilla'],
            ['42', 'Soria'],
            ['43', 'Tarragona'],
            ['44', 'Teruel'],
            ['45', 'Toledo'],
            ['46', 'Valencia'],
            ['47', 'Valladolid'],
            ['48', 'Bizkaia'],
            ['49', 'Zamora'],
            ['50', 'Zaragoza'],
            ['51', 'Ceuta'],
            ['52', 'Melilla'],
        ];

        foreach ($provincias as $provinciaData) {
            $provincia = new Provincia();
            $provincia->setCodigo((int)$provinciaData[0]);
            $provincia->setNombre($provinciaData[1]);
            $this->entityManager->persist($provincia);
        }

        $this->entityManager->flush();
        $io->success('Todas las provincias se han cargado.');
        return Command::SUCCESS;
    }
}
