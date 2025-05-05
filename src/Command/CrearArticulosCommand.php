<?php

namespace App\Command;

use App\Entity\Articulo;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:crear-articulos',
    description: 'Crea artículos de ejemplo en la base de datos',
)]
class CreateSampleArticlesCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Creando artículos de ejemplo...');

        $user = $this->entityManager->getRepository(Usuario::class)->find(1);
        if (!$user) {
            $io->error('No se encontró el usuario con ID 1');
            return Command::FAILURE;
        }

        $articulos = [
            [
                'titulo' => 'Guía de aves estivales en Castilla y León',
                'slug' => 'aves-estivales-castilla-leon',
                'imagen' => 'aves-estivales.jpg',
                'contenido' => $this->getAvesEstivalesContent(),
                'fecha' => new \DateTime()
            ],
            [
                'titulo' => 'Consejos para fotografiar aves en invierno',
                'slug' => 'fotografia-aves-invierno',
                'imagen' => 'fotografia-invierno.jpg',
                'contenido' => $this->getFotografiaInviernoContent(),
                'fecha' => new \DateTime('-1 day')
            ],
            [
                'titulo' => 'Las rapaces más emblemáticas de España',
                'slug' => 'rapaces-emblematicas-espana',
                'imagen' => 'rapaces-espana.jpg',
                'contenido' => $this->getRapacesContent(),
                'fecha' => new \DateTime('-2 days')
            ]
        ];

        foreach ($articulos as $articuloData) {
            $articulo = new Articulo();
            $articulo->setTitulo($articuloData['titulo']);
            $articulo->setSlug($articuloData['slug']);
            $articulo->setImagen($articuloData['imagen']);
            $articulo->setContenido($articuloData['contenido']);
            $articulo->setFechaPublicacion($articuloData['fecha']);
            $articulo->setAutor($user);

            $this->entityManager->persist($articulo);
            $io->text('Creado artículo: ' . $articuloData['titulo']);
        }

        $this->entityManager->flush();
        $io->success(sprintf('Se crearon %d artículos correctamente', count($articulos)));

        return Command::SUCCESS;
    }

    private function getAvesEstivalesContent(): string
    {
        return <<<HTML
<h2>Abejaruco Europeo</h2>
<p>El abejaruco europeo (Merops apiaster) es una de las aves más coloridas de nuestra fauna. Se puede observar de abril a septiembre en las riberas de los ríos de Castilla y León.</p>
<img src="/images/articulos/abejaruco.jpg" alt="Abejaruco europeo" class="img-fluid rounded mb-3">

<h2>Águila Calzada</h2>
<p>Esta rapaz estival (Hieraaetus pennatus) llega en primavera para reproducirse. Las mejores zonas para observarla son los bosques mediterráneos de la región.</p>

<h3>Mejores lugares para fotografía:</h3>
<ul>
    <li>Arribes del Duero</li>
    <li>Hoces del Riaza</li>
    <li>Cañón del Río Lobos</li>
</ul>
HTML;
    }

    private function getFotografiaInviernoContent(): string
    {
        return <<<HTML
<h2>Equipo recomendado</h2>
<p>Para fotografiar aves en invierno necesitarás:</p>
<ul>
    <li>Un teleobjetivo de al menos 300mm</li>
    <li>Ropa de abrigo impermeable</li>
    <li>Un trípode estable</li>
</ul>

<h2>Técnicas especiales</h2>
<p>El invierno ofrece oportunidades únicas:</p>
<img src="/images/articulos/aves-invierno.jpg" alt="Aves en invierno" class="img-fluid rounded mb-3">
<ol>
    <li>Busca concentraciones de aves acuáticas en humedales</li>
    <li>Aprovecha la nieve como fondo blanco</li>
    <li>Fotografía aves con plumaje invernal</li>
</ol>
HTML;
    }

    private function getRapacesContent(): string
    {
        return <<<HTML
<h2>Águila Imperial Ibérica</h2>
<p>El águila imperial ibérica (Aquila adalberti) es una de nuestras rapaces más emblemáticas y amenazadas.</p>
<img src="/images/articulos/aguila-imperial.jpg" alt="Águila Imperial" class="img-fluid rounded mb-3">

<h2>Buitre Leonado</h2>
<p>El buitre leonado (Gyps fulvus) es fácil de observar en muchas zonas de España, especialmente en cañones y cortados rocosos.</p>

<h3>Zonas de observación:</h3>
<ul>
    <li>Hoces del Duratón (Segovia)</li>
    <li>Monfragüe (Cáceres)</li>
    <li>Desfiladero de Pancorbo (Burgos)</li>
</ul>
HTML;
    }
}