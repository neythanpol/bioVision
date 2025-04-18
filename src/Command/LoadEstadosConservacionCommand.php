<?php

namespace App\Command;

use App\Entity\EstadoConservacion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-estados-conservacion',
    description: 'Carga los estados de conservación iniciales'
)]

class LoadEstadosConservacionCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Cargando estados de conservación...');

        $estados = [
            ['LC', 'Preocupación Menor', 'Especie abundante y de amplia distribución territorial que, una vez evaluada, se considera fuera de las categorías con mayor grado de amenaza.'],
            ['NT', 'Casi Amenazado', 'Especie que una vez evaluada, casi cumple los criterios para ser clasificada en una categoría con mayor grado de amenaza y debido a su tendencia, posiblemente los cumpla en un futuro próximo.'],
            ['EN', 'En Peligro', 'La especie se está enfrentando a un riesgo muy alto de extinción en estado silvestre.'],
            ['VU', 'Vulnerable', 'La especie se está enfrentando a un riesgo alto de extinción en estado silvestre.'],
            ['CR', 'En Peligro Crítico', 'La especie se está enfrentando a un riesgo extremadamente alto de extinción en estado silvestre.'],
            ['RE', 'Regionalmente Extinta', 'Especie extinta a nivel regional, no queda ninguna duda razonable de que el último individuo existente ha muerto, incluso en cautividad, en el ámbito territorial analizado, pudiendo evaluarse por separado la población reproductora y no reproductora.'],
            ['EX', 'Extinta', 'No queda ninguna duda razonable de que el último individuo existente ha muerto, incluso en cautividad. Para confirmar la extinción se han realizado prospecciones exhaustivas de sus hábitats en los momentos propicios, sin detectar ni un solo individuo.'],
            ['NE', 'No Evaluados', 'Especie aún no clasificada según los criterios de categorías en función del riesgo de extinción. Suelen ser especies no reproductoras, de aparición ocasional o rarezas que cuentan con información muy escasa y dispersa.'],
            ['DD', 'Datos Insuficientes', 'No hay información adecuada para hacer una evaluación, directa o indirecta, de su riesgo de extinción, basándose en la distribución o condición de la población, pero se considera la posibilidad de que investigaciones futuras impliquen la clasificación en alguna categoría de amenaza.']
        ];

        foreach ($estados as $data) {
            $estado = new EstadoConservacion();
            $estado->setCodigo($data[0]);
            $estado->setNombre($data[1]);
            $estado->setDescripcion($data[2]);

            $this->entityManager->persist($estado);
            $io->text(sprintf('Creado estado: %s', $estado));
        }

        $this->entityManager->flush();
        $output->writeln('Estados de conservación cargados correctamente.');

        return Command::SUCCESS;
    }
}
