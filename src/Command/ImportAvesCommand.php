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
                'nombreComun' => 'Abejero europeo',
                'nombreCientifico' => 'Pernis apivorus',
                'descripcion' => 'Estrechamente ligado a áreas boscosas, el abejero es una rapaz estival en nuestro país, que realiza largas singladuras hasta alcanzar el continente africano, donde inverna, para lo que necesita antes canalizar su migración a través del estrecho de Gibraltar, donde se concentra en gran número. Las adaptaciones a sus curiosas preferencias alimentarias (avispas, abejorros) lo llevan a sincronizar su ciclo reproductor y migración con el periodo de mayor abundancia de estas singulares presas para una rapaz.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 52.0,
                'longitudMaxima' => 59.0,
                'envergaduraMinima' => 113.0,
                'envergaduraMaxima' => 135.0,
                'estadoCodigo' => 'NT',
                'imagen' => 'abejero_europeo.jpg'
            ],
            [
                'nombreComun' => 'Abubilla común',
                'nombreCientifico' => 'Upupa epops',
                'descripcion' => 'Se trata de una de las aves más populares de la España mediterránea, muy abundante en las dehesas de la mitad meridional. Su característico reclamo, su llamativo penacho de plumas y su vuelo errático y ondulante la hacen fácilmente reconocible. Pese a ser una especie migradora transahariana, parte de la población reside todo el año en las regiones peninsulares más cálidas, así como en Baleares y Canarias, territorios que también acogen individuos europeos invernantes.',
                'orden' => 'Bucerotiformes',
                'familia' => 'Upupidae',
                'longitudMinima' => 23.0,
                'longitudMaxima' => 29.0,
                'envergaduraMinima' => 44.0,
                'envergaduraMaxima' => 48.0,
                'estadoCodigo' => 'LC',
                'imagen' => 'acentor_comun.jpg'
            ],
            [
                'nombreComun' => 'Acentor alpino',
                'nombreCientifico' => 'Prunella collaris',
                'descripcion' => 'Este típico pájaro de alta montaña puede vivir hasta en las cumbres más elevadas de Pirineos o Sierra Nevada, altitudes a las que se aventuran muy pocas especies. Frecuenta los principales macizos montañosos, aunque es más abundante en Pirineos y Picos de Europa. Suele acercarse a refugios y estaciones de esquí, donde se muestra muy confiado ante la presencia humana.',
                'orden' => 'Passeriformes',
                'familia' => 'Prunellidae',
                'longitudMinima' => 15.0,
                'longitudMaxima' => 17.0,
                'envergaduraMinima' => 30.0,
                'envergaduraMaxima' => 32.5,
                'estadoCodigo' => 'NT',
                'imagen' => 'abejero_europeo.jpg'
            ],
            [
                'nombreComun' => 'Agachadiza chica',
                'nombreCientifico' => 'Lymnocryptes minimus',
                'descripcion' => 'Esta pequeña limícola, de críptico plumaje y hábitos muy recatados, es uno de los más esquivos y desconocidos habitantes de nuestros humedales y áreas encharcables, donde se instala a lo largo del invierno y durante los pasos migratorios.',
                'orden' => 'Charadriiformes',
                'familia' => 'Scolopacidae',
                'longitudMinima' => 17.0,
                'longitudMaxima' => 19.0,
                'envergaduraMinima' => 38.0,
                'envergaduraMaxima' => 42.0,
                'estadoCodigo' => 'DD',
                'imagen' => 'abejero_europeo.jpg'
            ],
            [
                'nombreComun' => 'Agachadiza común',
                'nombreCientifico' => 'Gallinago gallinago',
                'descripcion' => 'Ave limícola muy esquiva y discreta, y una de las pocas especies de este grupo que crían en nuestro país, aunque lo hace de forma muy escasa y en unos pocos enclaves. Mucho más numerosa y repartida aparece durante los pasos migratorios y la invernada, cuando puede encontrarse en una gran variedad de humedales, tanto costeros como del interior.',
                'orden' => 'Charadriiformes',
                'familia' => 'Scolopacidae',
                'longitudMinima' => 25.0,
                'longitudMaxima' => 27.0,
                'envergaduraMinima' => 44.0,
                'envergaduraMaxima' => 47.0,
                'estadoCodigo' => 'EN',
                'imagen' => 'abejero_europeo.jpg'
            ],
            [
                'nombreComun' => 'Agateador euroasiático',
                'nombreCientifico' => 'Certhia familiaris',
                'descripcion' => 'Pequeña ave insectívora, escasa y restringida a los bosques alpinos de las montañas de la mitad norte peninsular. Resulta esquiva y poco conspicua por su coloración críptica, difícil de apreciar contra la corteza de los troncos, sobre los que suele pasar gran parte del día.',
                'orden' => 'Passeriformes',
                'familia' => 'Certhiidae',
                'longitudMinima' => 12.5,
                'longitudMaxima' => 15.0,
                'envergaduraMinima' => 17.5,
                'envergaduraMaxima' => 21.0,
                'estadoCodigo' => 'DD',
                'imagen' => 'agateador_euroasiatico.jpg'
            ],
            [
                'nombreComun' => 'Agateador europeo',
                'nombreCientifico' => 'Certhia brachydactyla',
                'descripcion' => 'Se trata de un pajarillo frecuente en nuestros bosques e incluso en nuestros parques, aunque no resulta fácil de observar. Su plumaje, de tonalidades marrones, es muy críptico, y, como además permanece mucho tiempo recorriendo los troncos de los árboles en busca de alimento, donde se camufla muy bien entre las cortezas, pasa muy inadvertido. Es mucho más fácil de detectar por su reclamo, integrado por unos profundos piídos.',
                'orden' => 'Passeriformes',
                'familia' => 'Certhiidae',
                'longitudMinima' => 11.0,
                'longitudMaxima' => 13.0,
                'envergaduraMinima' => 17.5,
                'envergaduraMaxima' => 20.0,
                'estadoCodigo' => 'LC',
                'imagen' => 'agateador_europeo.jpg'
            ],
            [
                'nombreComun' => 'Águila calzada',
                'nombreCientifico' => 'Hieraaetus pennatus',
                'descripcion' => 'Las áreas forestales y parcialmente arboladas de nuestro país, en particular las regiones del centro y el oeste de la Península, cuentan con la mayor población europea de una rapaz viajera, de vuelo ágil y aspecto estilizado, que se alimenta sobre todo de aves medianas, conejos y lagartos. Se trata del águila calzada, un ave que puede presentar dos fases de coloración muy diferentes y que, al contrario que otras rapaces, parece mantener poblaciones estables o en ligero aumento.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 42.0,
                'longitudMaxima' => 51.0,
                'envergaduraMinima' => 110.0,
                'envergaduraMaxima' => 135.0,
                'estadoCodigo' => 'LC',
                'imagen' => 'aguila_calzada.jpg'
            ],
            [
                'nombreComun' => 'Águila imperial ibérica',
                'nombreCientifico' => 'Aquila adalberti',
                'descripcion' => 'Endémica de la Península, se trata de una de las aves más emblemáticas y amenazadas de nuestra fauna, que estuvo al borde de la extinción, aunque se ha venido recuperando en las últimas décadas. Habita en el centrosuroeste peninsular, fundamentalmente en sierras con extensas formaciones de monte mediterráneo y, en menor medida, en pinares del Sistema Central.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 68.0,
                'longitudMaxima' => 83.0,
                'envergaduraMinima' => 180.0,
                'envergaduraMaxima' => 220.0,
                'estadoCodigo' => 'EN',
                'imagen' => 'aguila_imperial_iberica.jpg'
            ],
            [
                'nombreComun' => 'Águila perdicera',
                'nombreCientifico' => 'Aquila fasciata',
                'descripcion' => 'Entre las grandes águilas, es la más ágil, lo que le permite cazar un gran número de aves de tamaño medio, y también la de coloración más pálida. Está muy asociada a ambientes mediterráneos, y por eso sus poblaciones más importantes se encuentran acantonadas en Extremadura, en las sierras del Levante y en la región oriental andaluza.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 60.0,
                'longitudMaxima' => 70.0,
                'envergaduraMinima' => 150.0,
                'envergaduraMaxima' => 170.0,
                'estadoCodigo' => 'VU',
                'imagen' => 'aguila_perdicera.jpg'
            ],
            [
                'nombreComun' => 'Águila pescadora',
                'nombreCientifico' => 'Pandion haliaetus',
                'descripcion' => 'Esta rapaz, estrictamente ligada al medio acuático y de alimentación exclusivamente piscívora, está muy extendida a nivel mundial, aunque en nuestro país es una de las aves de presa más escasas. En la segunda mitad del siglo XX la población reproductora en España sufrió una drástica disminución hasta casi la extinción, afortunadamente frenada gracias a las labores de conservación de la especie. En invierno nuestro territorio recibe numerosos contingentes procedentes de latitudes norteñas y durante los pasos migratorios es posible observarla también en humedales de interior.',
                'orden' => 'Accipitriformes',
                'familia' => 'Pandionidae',
                'longitudMinima' => 53.0,
                'longitudMaxima' => 66.0,
                'envergaduraMinima' => 147.0,
                'envergaduraMaxima' => 174.0,
                'estadoCodigo' => 'EN',
                'imagen' => 'aguila_pescadora.jpg'
            ],
            [
                'nombreComun' => 'Águila real',
                'nombreCientifico' => 'Aquila chrysaetos',
                'descripcion' => 'La real es la más poderosa de nuestras águilas y una de las aves de presa más extendidas a escala mundial. En España está extendida únicamente por la Península, donde ocupa la mayor parte de las áreas montañosas o de relieve quebrado y montuoso. Es una rapaz esencialmente rupícola, que instala casi siempre sus nidos en cantiles rocosos, aunque en ocasiones también lo hace en árboles. Su dieta es muy variada, e incluye una gran variedad de mamíferos, aves e incluso reptiles, y también carroña.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 76.0,
                'longitudMaxima' => 96.0,
                'envergaduraMinima' => 180.0,
                'envergaduraMaxima' => 230.0,
                'estadoCodigo' => 'NT',
                'imagen' => 'aguila_real.jpg'
            ],
            [
                'nombreComun' => 'Aguilucho cenizo',
                'nombreCientifico' => 'Circus pygargus',
                'descripcion' => 'Pocas rapaces hay tan ligadas a las actividades humanas como el grácil aguilucho cenizo, una especie que, en nuestro territorio, depende estrechamente de las grandes extensiones cultivadas de trigo y cebada, donde, a falta de los grandes herbazales que conforman en otros lugares su hábitat predilecto, instala los nidos. A cambio de alojarse en los cultivos del hombre, el aguilucho cenizo elimina ingentes cantidades de topillos, ratones, langostas y aves granívoras, que constituyen sus presas habituales.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 39.0,
                'longitudMaxima' => 46.0,
                'envergaduraMinima' => 102.0,
                'envergaduraMaxima' => 116.0,
                'estadoCodigo' => 'VU',
                'imagen' => 'aguilucho_cenizo.jpg'
            ],
            [
                'nombreComun' => 'Aguilucho lagunero occidental',
                'nombreCientifico' => 'Circus aeruginosus',
                'descripcion' => 'La figura ingrávida del aguilucho lagunero patrullando incansablemente sobre carrizales y marjales se convirtió en una imagen bastante poco frecuente hace algunas décadas, cuando la transformación de los humedales y la persecución directa redujeron a poco más de 200 las parejas de estas rapaces. Actualmente, la población española se recupera lentamente, aunque está lejos de alcanzar la de otros países europeos, donde este aguilucho resulta más abundante.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 43.0,
                'longitudMaxima' => 55.0,
                'envergaduraMinima' => 115.0,
                'envergaduraMaxima' => 140.0,
                'estadoCodigo' => 'LC',
                'imagen' => 'aguilucho_lagunero_occidental.jpg'
            ],
            [
                'nombreComun' => 'Aguilucho pálido',
                'nombreCientifico' => 'Circus cyaneus',
                'descripcion' => 'El aguilucho pálido es una rapaz propia de las latitudes templadas y frías del Holártico que, en nuestro país, se reproduce en espesos tojales, carrizales y brezales del norte peninsular, aunque, en invierno, su imagen liviana patrullando sobre los inmensos campos de cereales, vegas y humedales de numerosas localidades españolas es algo bastante habitual. Desde hace algunos años son numerosas las parejas de esta especie que se han asentado en las llanuras cerealistas del centro de la Península, donde comparten hábitat con su cercano pariente el aguilucho cenizo.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 45.0,
                'longitudMaxima' => 55.0,
                'envergaduraMinima' => 97.0,
                'envergaduraMaxima' => 118.0,
                'estadoCodigo' => 'EN',
                'imagen' => 'aguilucho_palido.jpg'
            ],
            [
                'nombreComun' => 'Aguilucho papialbo',
                'nombreCientifico' => 'Circus macrourus',
                'descripcion' => 'El aguilucho papialbo ha dejado de considerarse un ave ocasional en España, y cada vez es menos infrecuente verlo durante sus migraciones prenupciales surcar los cielos peninsulares, lo que sugiere el posible establecimiento de una nueva ruta migratoria para la especie. Existen registros de individuos que, de manera puntual, hacen aquí la invernada, así como de su hibridación ocasional con aguiluchos cenizos.',
                'orden' => 'Accipitriformes',
                'familia' => 'Accipitridae',
                'longitudMinima' => 40.0,
                'longitudMaxima' => 50.0,
                'envergaduraMinima' => 100.0,
                'envergaduraMaxima' => 120.0,
                'estadoCodigo' => 'NE',
                'imagen' => 'aguilucho_papialbo.jpg'
            ],
            [
                'nombreComun' => 'Aguja colinegra',
                'nombreCientifico' => 'Limosa limosa',
                'descripcion' => 'La aguja colinegra, con su considerable tamaño y su largo pico, es una de las limícolas más fácilmente identificables, salvo una posible confusión con la aguja colipinta. Se trata de una especie fundamentalmente invernante que también resulta bastante común durante la migración. Tanto en una época como en la otra, ocupa marismas, saladares, arrozales, humedales interiores y estuarios. Se han registrado algunas reproducciones esporádicas en diferentes regiones de la Península.',
                'orden' => 'Charadriiformes',
                'familia' => 'Scolopacidae',
                'longitudMinima' => 37.0,
                'longitudMaxima' => 42.0,
                'envergaduraMinima' => 63.0,
                'envergaduraMaxima' => 74.0,
                'estadoCodigo' => 'CR',
                'imagen' => 'aguja_colinegra.jpg'
            ],
            [
                'nombreComun' => 'Aguja colipinta',
                'nombreCientifico' => 'Limosa lapponica',
                'descripcion' => 'Más costera que su pariente la colinegra, la aguja colipinta es un ave migradora que en nuestro territorio aparece sobre todo a lo largo de los pasos migratorios y, con mucha menor frecuencia, durante el periodo invernal. Ocupa entonces playas, estuarios, marismas y aguazales costeros de la fachada cántabro-atlántica de la Península, en los que encuentra un abundante surtido de los gusanos, insectos, crustáceos y pequeños moluscos que habitualmente componen su dieta.',
                'orden' => 'Charadriiformes',
                'familia' => 'Scolopacidae',
                'longitudMinima' => 37.0,
                'longitudMaxima' => 39.0,
                'envergaduraMinima' => 70.0,
                'envergaduraMaxima' => 80.0,
                'estadoCodigo' => 'LC',
                'imagen' => 'aguja_colipinta.jpg'
            ],
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
