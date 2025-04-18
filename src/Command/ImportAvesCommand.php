<?php

namespace App\Command;

use App\Entity\Ave;
use App\Entity\EstadoConservacion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import-aves',
    description: 'Importa aves a la base de datos'
)]
class ImportAvesCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ){
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Importando aves...');

        $aves = [
            [
                'nombreComun' => 'Abejaruco europeo',
                'nombreCientifico' => 'Merops apiaster',
                'descripcion' => 'El abejaruco europeo es una de las aves más vistosas de nuestra fauna. Tal y como su nombre indica, se trata de un especialista en el consumo de abejas, aunque también se alimenta de otros insectos voladores. Aparte de por su colorido, uno de los más llamativos de las aves europeas, resulta muy fácil de reconocer por su característico reclamo, que emite constantemente mientras vuela y que puede ser oído desde largas distancias.',
                'orden' => 'Coraciiformes',
                'familia' => 'Meropidae',
                'longitudMinima' => 27.0,
                'longitudMaxima' => 29.0,
                'envergaduraMinima' => 44.0,
                'envergaduraMaxima' => 49.0,
                'estadoCodigo' => 'LC',
                'imagen' => 'abejaruco_europeo.jpg'
            ],
            [
                'nombreComun' => 'Acentor común',
                'nombreCientifico' => 'Prunella modularis',
                'descripcion' => 'Ave frecuente en zonas de montaña con abundancia de matorral y de sotobosque. En la mitad norte peninsular aparece en ambientes más diversos, pero en el sur se restringe a los sistemas montañosos. España alberga una población residente, a la que se unen en invierno acentores europeos pertenecientes a otra subespecie.',
                'orden' => 'Passeriformes',
                'familia' => 'Prunellidae',
                'longitudMinima' => 13.0,
                'longitudMaxima' => 14.0,
                'envergaduraMinima' => 19.0,
                'envergaduraMaxima' => 21.0,
                'estadoCodigo' => 'LC',
                'imagen' => 'acentor_comun.jpg'
            ]
        ];

        foreach ($aves as $aveData) {
            $ave = new Ave();
            $ave->setNombreComun($aveData['nombreComun']);
            $ave->setNombreCientifico($aveData['nombreCientifico']);
            $ave->setDescripcion($aveData['descripcion']);
            $ave->setOrden($aveData['orden']);
            $ave->setFamilia($aveData['familia']);
            $ave->setLongitudMinima($aveData['longitudMinima']);
            $ave->setLongitudMaxima($aveData['longitudMaxima']);
            $ave->setEnvergaduraMinima($aveData['envergaduraMinima']);
            $ave->setEnvergaduraMaxima($aveData['envergaduraMaxima']);
            $ave->setImagenNombre($aveData['imagen']);

            // Asignar estado de conservación
            $estado = $this->entityManager
                ->getRepository(EstadoConservacion::class)
                ->findOneBy(['codigo' => $aveData['estadoCodigo']]);

            if ($estado) {
                $ave->setEstadoConservacion($estado);
            }

            $this->entityManager->persist($ave);
            $io->text('Añadido: ' . $aveData['nombreComun']);
        }

        $this->entityManager->flush();
        $io->success('¡Se importaron ' . count($aves) . ' aves correctamente!');

        return Command::SUCCESS;
    }
}
