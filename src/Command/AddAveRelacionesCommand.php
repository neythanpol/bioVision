<?php

namespace App\Command;

use App\Entity\Ave;
use App\Entity\Provincia;
use App\Entity\Periodo;
use App\Entity\AveProvinciaPeriodo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:add-ave-relaciones',
    description: 'Añade relaciones ave-provincia-periodo a aves existentes',
)]
class AddAveRelacionesCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        // Obtener repositorios
        $aveRepo = $this->entityManager->getRepository(Ave::class);
        $provinciaRepo = $this->entityManager->getRepository(Provincia::class);
        $periodoRepo = $this->entityManager->getRepository(Periodo::class);

        // 1. Acentor Común
        $acentorComun = $aveRepo->findOneBy(['nombreComun' => 'Acentor común']);
        if ($acentorComun) {
            $this->procesarAcentorComun($acentorComun, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para Acentor común.');
        }

        // 2. Abejaruco Europeo
        $abejarucoEuropeo = $aveRepo->findOneBy(['nombreComun' => 'Abejaruco europeo']);
        if ($abejarucoEuropeo) {
            $this->procesarAbejarucoEuropeo($abejarucoEuropeo, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para Abejaruco europeo.');
        }

        $this->entityManager->flush();
        $io->success('Relaciones añadidas correctamente.');

        return Command::SUCCESS;
    }

    private function procesarAcentorComun(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);
        $invernante = $periodoRepo->findOneBy(['tipo' => 'Invernante']);

        // Provincias residentes
        $provinciasResidente = [15, 36, 27, 32, 33, 39, 24, 9, 48, 20, 1, 22, 25, 8, 44, 12, 40, 5, 10, 18];
        foreach ($provinciasResidente as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }

        // Provincias invernantes
        $todasProvincias = range(1, 52);
        $provinciasInvernante = array_diff($todasProvincias, $provinciasResidente);
        foreach ($provinciasInvernante as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAbejarucoEuropeo(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $estival = $periodoRepo->findOneBy(['tipo' => 'Estival']);

        // Provincias estivales
        $provinciasEstival = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 16, 17, 18, 19, 21, 22, 23, 24, 25, 26, 28, 29, 30, 31, 34, 35, 37, 38, 40, 41, 42, 43, 44, 45, 46, 47, 49, 50, 51, 52];
        foreach ($provinciasEstival as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $estival)) {
                $this->crearRelacion($ave, $provincia, $estival);
            }
        }
    }

    private function existeRelacion(Ave $ave, Provincia $provincia, Periodo $periodo): bool
    {
        return $this->entityManager->getRepository(AveProvinciaPeriodo::class)->findOneBy([
            'ave' => $ave,
            'provincia' => $provincia,
            'periodo' => $periodo
        ]) !== null;
    }

    private function crearRelacion(Ave $ave, Provincia $provincia, Periodo $periodo): void
    {
        $relacion = new AveProvinciaPeriodo();
        $relacion->setAve($ave);
        $relacion->setProvincia($provincia);
        $relacion->setPeriodo($periodo);

        $this->entityManager->persist($relacion);
    }
}
