<?php

namespace App\Command;

use App\Entity\Articulo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:load-articles',
    description: 'Carga los artículos iniciales en la base de datos'
)]
class LoadArticlesCommand extends Command
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $articles = [
            [
                'titulo' => 'Aves estivales en Castilla y León',
                'slug' => 'aves-estivales-castilla-leon',
                'imagen' => 'aves-estivales.jpg',
                'fecha_publicacion' => new \DateTime('2023-06-15'),
                'contenido' => <<<EOT
<h2>Abejaruco Europeo</h2>
<p>El abejaruco europeo (Merops apiaster) es una de las aves más coloridas que podemos encontrar en Castilla y León durante los meses de verano.</p>
<img src="/images/articulos/abejaruco.jpg" class="img-fluid rounded mb-3" alt="Abejaruco europeo">

<h2>Águila Calzada</h2>
<p>Esta rapaz llega en primavera desde África para reproducirse en nuestros bosques.</p>

<h3>Mejores lugares para observación:</h3>
<ul>
    <li>Arribes del Duero (Salamanca/Zamora)</li>
    <li>Hoces del Riaza (Segovia)</li>
    <li>Cañón del Río Lobos (Soria/Burgos)</li>
</ul>

<div class="alert alert-info mt-4">
    <h4>Consejos para fotografiar aves estivales:</h4>
    <ul>
        <li>Usa ropa discreta y evita movimientos bruscos</li>
        <li>Las primeras horas de la mañana son las mejores</li>
        <li>Busca puntos de agua donde las aves acuden a beber</li>
    </ul>
</div>
EOT
            ],
            [
                'titulo' => 'Aves emblemáticas de España',
                'slug' => 'aves-emblematicas-espana',
                'imagen' => 'aves-espana.jpg',
                'fecha_publicacion' => new \DateTime('2023-07-20'),
                'contenido' => <<<EOT
<h2>Águila Imperial Ibérica</h2>
<p>El águila imperial ibérica (Aquila adalberti) es una de las rapaces más emblemáticas y amenazadas de la península ibérica, siendo España el principal hogar de esta especie.</p>
<img src="/images/articulos/aguila-imperial.jpg" class="img-fluid rounded mb-3" alt="Águila imperial ibérica">

<h2>Buitre Negro</h2>
<p>Con una envergadura que puede superar los 3 metros, el buitre negro (Aegypius monachus) es una de las mayores aves de Europa y España alberga importantes colonias.</p>

<h3>Principales zonas de observación:</h3>
<ul>
    <li>Parque Nacional de Monfragüe (Extremadura)</li>
    <li>Sierra de San Pedro (Extremadura)</li>
    <li>Parque Natural de la Sierra de Andújar (Jaén)</li>
    <li>Hoces del Riaza (Segovia)</li>
</ul>

<h2>Avutarda Común</h2>
<p>La avutarda (Otis tarda) es el ave voladora más pesada del mundo y España cuenta con más del 50% de la población mundial.</p>
<img src="/images/articulos/avutarda.jpg" class="img-fluid rounded mb-3" alt="Avutarda común">

<div class="alert alert-info mt-4">
    <h4>Consejos para el avistamiento de aves:</h4>
    <ul>
        <li>Utiliza prismáticos o telescopios de calidad</li>
        <li>Respeta las distancias y no alteres el comportamiento natural</li>
        <li>Consulta guías de aves para identificar especies</li>
        <li>Las estaciones de primavera y otoño son ideales para la observación</li>
    </ul>
</div>

<h3>Especies únicas de España:</h3>
<p>Nuestro país alberga varias especies endémicas o casi endémicas de la península ibérica:</p>
<ul>
    <li>Pardela balear (Puffinus mauretanicus)</li>
    <li>Rabilargo ibérico (Cyanopica cooki)</li>
    <li>Herrerillo canario (Cyanistes teneriffae)</li>
</ul>
EOT
            ]
        ];
        
        foreach ($articles as $articleData) {
            $article = new Articulo();
            $article->setTitulo($articleData['titulo']);
            $article->setSlug($articleData['slug']);
            $article->setImagen($articleData['imagen']);
            $article->setFechaPublicacion($articleData['fecha_publicacion']);
            $article->setContenido($articleData['contenido']);
            
            $this->entityManager->persist($article);
        }
        
        $this->entityManager->flush();
        
        $output->writeln('Artículos cargados correctamente!');
        
        return Command::SUCCESS;
    }
}