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

        // 1. Abubilla Común
        $abubillaComun = $aveRepo->findOneBy(['nombreComun' => 'Abubilla común']);
        if ($abubillaComun) {
            $this->procesarAbubillaComun($abubillaComun, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para abubilla común.');
        }

        // 2. Abejero Europeo
        $abejeroEuropeo = $aveRepo->findOneBy(['nombreComun' => 'Abejero europeo']);
        if ($abejeroEuropeo) {
            $this->procesarAbejeroEuropeo($abejeroEuropeo, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para abejero europeo.');
        }

        // 3. Acentor Alpino
        $acentorAlpino = $aveRepo->findOneBy(['nombreComun' => 'Acentor alpino']);
        if ($acentorAlpino) {
            $this->procesarAcentorAlpino($acentorAlpino, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para acentor alpino.');
        }

        // 4. Agachadiza Chica
        $agachadizaChica = $aveRepo->findOneBy(['nombreComun' => 'Agachadiza chica']);
        if ($agachadizaChica) {
            $this->procesarAgachadizaChica($agachadizaChica, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para agachadiza chica.');
        }

        // 5. Agachadiza Común
        $agachadizaComun = $aveRepo->findOneBy(['nombreComun' => 'Agachadiza comun']);
        if ($agachadizaComun) {
            $this->procesarAgachadizaComun($agachadizaComun, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para agachadiza comun.');
        }

        // 6. Agateador Euroasiático
        $agateadorEuroasiatico = $aveRepo->findOneBy(['nombreComun' => 'Agateador euroasiatico']);
        if ($agateadorEuroasiatico) {
            $this->procesarAgateadorEuroasiatico($agateadorEuroasiatico, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para agateador euroasiatico.');
        }

        // 7. Agateador Europeo
        $agateadorEuropeo = $aveRepo->findOneBy(['nombreComun' => 'Agateador europeo']);
        if ($agateadorEuropeo) {
            $this->procesarAgateadorEuropeo($agateadorEuropeo, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para agateador europeo.');
        }

        // 8. Águila Calzada
        $aguilaCalzada = $aveRepo->findOneBy(['nombreComun' => 'Águila calzada']);
        if ($aguilaCalzada) {
            $this->procesarAguilaCalzada($aguilaCalzada, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para águila calzada.');
        }

        // 9. Águila Imperial Ibérica
        $aguilaImperialIberica = $aveRepo->findOneBy(['nombreComun' => 'Águila imperial ibérica']);
        if ($aguilaImperialIberica) {
            $this->procesarAguilaImperialIberica($aguilaImperialIberica, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para águila imperial ibérica.');
        }

        // 10. Águila Perdicera
        $aguilaPerdicera = $aveRepo->findOneBy(['nombreComun' => 'Águila perdicera']);
        if ($aguilaPerdicera) {
            $this->procesarAguilaPerdicera($aguilaPerdicera, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para águila perdicera.');
        }

        // 11. Águila Pescadora
        $aguilaPescadora = $aveRepo->findOneBy(['nombreComun' => 'Águila pescadora']);
        if ($aguilaPescadora) {
            $this->procesarAguilaPescadora($aguilaPescadora, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para águila pescadora.');
        }

        // 12. Águila Real
        $aguilaReal = $aveRepo->findOneBy(['nombreComun' => 'Águila real']);
        if ($aguilaReal) {
            $this->procesarAguilaReal($aguilaReal, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para águila real.');
        }

        // 13. Águilucho Cenizo
        $aguiluchoCenizo = $aveRepo->findOneBy(['nombreComun' => 'Aguilucho cenizo']);
        if ($aguiluchoCenizo) {
            $this->procesarAguiluchoCenizo($aguiluchoCenizo, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para aguilucho cenizo.');
        }

        // 14. Águilucho Lagunero Occidental
        $aguiluchoLaguneroOccidental = $aveRepo->findOneBy(['nombreComun' => 'Aguilucho lagunero occidental']);
        if ($aguiluchoLaguneroOccidental) {
            $this->procesarAguiluchoLaguneroOccidental($aguiluchoLaguneroOccidental, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para aguilucho lagunero occidental.');
        }

        // 15. Águilucho Pálido
        $aguiluchoPalido = $aveRepo->findOneBy(['nombreComun' => 'Aguilucho pálido']);
        if ($aguiluchoPalido) {
            $this->procesarAguiluchoPalido($aguiluchoPalido, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para aguilucho pálido.');
        }

        // 16. Águilucho Papialbo
        $aguiluchoPapialbo = $aveRepo->findOneBy(['nombreComun' => 'Aguilucho papialbo']);
        if ($aguiluchoPapialbo) {
            $this->procesarAguiluchoPapialbo($aguiluchoPapialbo, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para aguilucho papialbo.');
        }

        // 17. Aguja Colinegra
        $AgujaColinegra = $aveRepo->findOneBy(['nombreComun' => 'Aguja colinegra']);
        if ($AgujaColinegra) {
            $this->procesarAgujaColinegra($AgujaColinegra, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para aguja colinegra.');
        }

        // 18. Aguja Colipinta
        $AgujaColipinta = $aveRepo->findOneBy(['nombreComun' => 'Aguja colipinta']);
        if ($AgujaColipinta) {
            $this->procesarAgujaColipinta($AgujaColipinta, $provinciaRepo, $periodoRepo);
            $io->text('Relaciones añadidas para aguja colipinta.');
        }

        $this->entityManager->flush();
        $io->success('Relaciones añadidas correctamente.');

        return Command::SUCCESS;
    }

    private function procesarAbubillaComun(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);
        $estival = $periodoRepo->findOneBy(['tipo' => 'Estival']);

        // Provincias residentes
        $provinciasResidente = [3, 4, 6, 7, 11, 12, 18, 21, 29, 30, 35, 38, 41, 43, 45, 46, 51, 52];
        foreach ($provinciasResidente as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }

        // Provincias estivales
        $provinciasEstival = [1, 2, 5, 8, 9, 10, 13, 14, 15, 16, 17, 19, 22, 23, 24, 25, 26, 27, 28, 31, 32, 34, 36, 37, 40, 42, 44, 47, 49, 50];
        foreach ($provinciasEstival as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $estival)) {
                $this->crearRelacion($ave, $provincia, $estival);
            }
        }
    }

    private function procesarAbejeroEuropeo(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $estival = $periodoRepo->findOneBy(['tipo' => 'Estival']);

        // Provincias estivales
        $provinciasEstival = [1, 5, 10, 15, 17, 20, 22, 25, 26, 27, 31, 32, 33, 36, 37, 39, 40, 48, 50];
        foreach ($provinciasEstival as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $estival)) {
                $this->crearRelacion($ave, $provincia, $estival);
            }
        }
    }

    private function procesarAcentorAlpino(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);
        $invernante = $periodoRepo->findOneBy(['tipo' => 'Invernante']);

        // Provincias residentes
        $provinciasResidente = [1, 5, 10, 18, 20, 22, 24, 25, 26, 33, 34, 39, 41, 42, 48, 49];
        foreach ($provinciasResidente as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }

        // Provincias invernantes
        $provinciasInvernante = [1, 2, 5, 9, 12, 15, 17, 18, 19, 22, 24, 25, 28, 31, 33, 34, 37, 39, 40, 42, 44, 49, 50, 51];
        foreach ($provinciasInvernante as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAgachadizaChica(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $invernante = $periodoRepo->findOneBy(['tipo' => 'invernante']);

        // Provincias invernantes
        $provinciasInvernantes = [3, 6, 7, 8, 11, 15, 16, 17, 21, 22, 24, 28, 29, 31, 32, 33, 34, 36, 39, 43, 45, 46, 47, 48, 49, 50, 51, 52];
        foreach ($provinciasInvernantes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAgachadizaComun(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);
        $invernante = $periodoRepo->findOneBy(['tipo' => 'Invernante']);

        // Provincias residentes
        $provinciasResidente = [5, 32, 49];
        foreach ($provinciasResidente as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }

        // Provincias invernantes
        $provinciasInvernante = [1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 33, 34, 35, 36, 37, 38, 40, 41, 42, 43, 44, 45, 46, 47, 48, 50, 51, 52];
        foreach ($provinciasInvernante as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAgateadorEuroasiatico(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);

        // Provincias residentes
        $provinciasResidentes = [22, 24, 25, 26, 31, 33, 34, 39];
        foreach ($provinciasResidentes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }
    }

    private function procesarAgateadorEuropeo(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);

        // Provincias residentes
        $provinciasResidentes = [1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 36, 37, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51];
        foreach ($provinciasResidentes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }
    }

    private function procesarAguilaCalzada(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);
        $invernante = $periodoRepo->findOneBy(['tipo' => 'Invernante']);
        $estival = $periodoRepo->findOneBy(['tipo' => 'Estival']);

        // Provincias residentes
        $provinciasResidente = [7, 11, 21, 29];
        foreach ($provinciasResidente as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }

        // Provincias invernantes
        $provinciasInvernante = [3, 4, 8, 12, 30, 43, 46];
        foreach ($provinciasInvernante as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }

        // Provincias estivales
        $provinciasEstival = [1, 2, 5, 9, 10, 16, 18, 19, 20, 22, 23, 24, 25, 26, 27, 28, 31, 34, 37, 40, 42, 44, 45, 47, 49, 51];
        foreach ($provinciasEstival as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $estival)) {
                $this->crearRelacion($ave, $provincia, $estival);
            }
        }
    }

    private function procesarAguilaImperialIberica(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);

        // Provincias residentes
        $provinciasResidentes = [2, 5, 6, 10, 11, 13, 14, 19, 21, 23, 28, 40, 41, 45];
        foreach ($provinciasResidentes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }
    }

    private function procesarAguilaPerdicera(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);

        // Provincias residentes
        $provinciasResidentes = [2, 3, 4, 6, 7, 8, 10, 11, 12, 13, 14, 16, 17, 18, 19, 21, 23, 25, 26, 29, 30, 37, 41, 43, 44, 45, 46, 49, 50];
        foreach ($provinciasResidentes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }
    }

    private function procesarAguilaPescadora(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);
        $invernante = $periodoRepo->findOneBy(['tipo' => 'Invernante']);

        // Provincias residentes
        $provinciasResidente = [7, 35, 38];
        foreach ($provinciasResidente as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }

        // Provincias invernantes
        $provinciasInvernante = [11, 17, 21, 43, 51];
        foreach ($provinciasInvernante as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAguilaReal(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);

        // Provincias residentes
        $provinciasResidentes = [1, 2, 3, 4, 6, 8, 9, 10, 11, 12, 13, 14, 16, 17, 18, 19, 21, 22, 23, 24, 25, 26, 28, 29, 30, 31, 32, 33, 34, 37, 39, 40, 41, 42, 43, 44, 45, 46, 49, 50];
        foreach ($provinciasResidentes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }
    }

    private function procesarAguiluchoCenizo(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $estival = $periodoRepo->findOneBy(['tipo' => 'Estival']);

        // Provincias estivales
        $provinciasEstival = [1, 2, 3, 5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 36, 37, 39, 40, 41, 42, 43, 44, 45, 47, 49, 50];
        foreach ($provinciasEstival as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $estival)) {
                $this->crearRelacion($ave, $provincia, $estival);
            }
        }
    }

    private function procesarAguiluchoLaguneroOccidental(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);
        $invernante = $periodoRepo->findOneBy(['tipo' => 'Invernante']);

        // Provincias residentes
        $provinciasResidente = [1, 2, 7, 11, 13, 14, 16, 17, 18, 19, 21, 22, 23, 24, 25, 29, 31, 34, 40, 42, 45, 47, 49, 50];
        foreach ($provinciasResidente as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }

        // Provincias invernantes
        $provinciasInvernante = [3, 4, 5, 6, 8, 9, 10, 12, 15, 20, 26, 28, 30, 33, 36, 37, 39, 41, 43, 44, 46, 51, 52];
        foreach ($provinciasInvernante as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAguiluchoPalido(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $residente = $periodoRepo->findOneBy(['tipo' => 'Residente']);
        $invernante = $periodoRepo->findOneBy(['tipo' => 'Invernante']);

        // Provincias residentes
        $provinciasResidente = [1, 9, 13, 15, 17, 19, 20, 24, 26, 27, 28, 31, 32, 33, 34, 36, 37, 39, 40, 45, 48, 49];
        foreach ($provinciasResidente as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $residente)) {
                $this->crearRelacion($ave, $provincia, $residente);
            }
        }

        // Provincias invernantes
        $provinciasInvernante = [2, 3, 4, 5, 6, 7, 8, 10, 11, 12, 14, 16, 18, 21, 22, 23, 25, 29, 30, 41, 42, 43, 44, 46, 47, 50, 51];
        foreach ($provinciasInvernante as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAguiluchoPapialbo(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $invernante = $periodoRepo->findOneBy(['tipo' => 'invernante']);

        // Provincias invernantes
        $provinciasInvernantes = [2, 6, 10, 11, 12, 13, 30, 45, 46, 50];
        foreach ($provinciasInvernantes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAgujaColinegra(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $invernante = $periodoRepo->findOneBy(['tipo' => 'invernante']);

        // Provincias invernantes
        $provinciasInvernantes = [3, 4, 6, 10, 11, 15, 21, 27, 36, 39, 41, 43, 45, 46];
        foreach ($provinciasInvernantes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
            }
        }
    }

    private function procesarAgujaColipinta(Ave $ave, $provinciaRepo, $periodoRepo): void
    {
        $invernante = $periodoRepo->findOneBy(['tipo' => 'invernante']);

        // Provincias invernantes
        $provinciasInvernantes = [3, 11, 15, 21, 27, 35, 36, 38, 39, 41, 43];
        foreach ($provinciasInvernantes as $codigo) {
            $provincia = $provinciaRepo->findOneBy(['codigo' => $codigo]);
            if ($provincia && !$this->existeRelacion($ave, $provincia, $invernante)) {
                $this->crearRelacion($ave, $provincia, $invernante);
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
