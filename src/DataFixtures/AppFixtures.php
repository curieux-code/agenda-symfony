<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\City;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Image;
use App\Entity\Place;
use App\Entity\Video;
use App\Entity\Prices;
use App\Entity\Region;
use App\Entity\Rubric;
use App\Entity\Ticket;
use App\Entity\Borough;
use App\Entity\Comment;
use App\Entity\Country;
use App\Entity\Category;
use App\Entity\District;
use App\Entity\Festival;
use App\Entity\Postcode;
use App\Entity\Placetype;
use App\Entity\Reduction;
use App\Entity\Ticketing;
use App\Entity\Department;
use App\Entity\Videostore;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();


        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        // Utilisateur admin
        $users = [];
        $adminUser = new User();
        $adminUser->setFirstName('Bruno')
                  ->setLastName('Eichenberger')
                  ->setEmail('bruno@curieux.net')
                  ->setIntroduction($faker->sentence())
                  ->setPresentation( '<p>' . join('</p><p>' , $faker->paragraphs(3)) . '</p>')
                  ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                  ->setAvatar('https://cdn.iconscout.com/icon/free/png-256/avatar-375-456327.png')
                  ->addUserRole($adminRole);
        $manager->persist($adminUser);
        $users[] = $adminUser;


        $users = [];
        $adminUser = new User();
        $adminUser->setFirstName('Filou')
                  ->setLastName('Curieux')
                  ->setEmail('filou@curieux.net')
                  ->setIntroduction($faker->sentence())
                  ->setPresentation( '<p>' . join('</p><p>' , $faker->paragraphs(3)) . '</p>')
                  ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                  ->setAvatar('https://cdn.iconscout.com/icon/free/png-256/avatar-375-456327.png')
                  ->addUserRole($adminRole);
        $manager->persist($adminUser);
        $users[] = $adminUser;

        $users = [];
        $adminUser = new User();
        $adminUser->setFirstName('David')
                  ->setLastName('Curieux')
                  ->setEmail('david@curieux.net')
                  ->setIntroduction($faker->sentence())
                  ->setPresentation( '<p>' . join('</p><p>' , $faker->paragraphs(3)) . '</p>')
                  ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                  ->setAvatar('https://banner2.kisspng.com/20180615/rtc/kisspng-avatar-user-profile-male-logo-profile-icon-5b238cb002ed52.870627731529056432012.jpg')
                  ->addUserRole($adminRole);
        $manager->persist($adminUser);
        $users[] = $adminUser;


        // Utilisateurs
        $genres = ['male','female'];

        for ($i = 1; $i <= 10; $i++){
            $user = new User();

            $genre = $faker->randomElement($genres);

            $avatar = 'https://randomuser.me/api/portraits/';
            $avatarId = $faker->numberBetween(1, 99) . '.jpg';

            $avatar .= ($genre == "male" ? 'men/' : 'women/') . $avatarId;

            $hash = $this->encoder->encodePassword($user, 'password');

            $user->setFirstName($faker->firstname($genre))
                 ->setLastName($faker->lastname)
                 ->setEmail($faker->email)
                 ->setIntroduction($faker->sentence())
                 ->setPresentation( '<p>' . join('</p><p>' , $faker->paragraphs(3)) . '</p>')
                 ->setHash($hash)
                 ->setAvatar($avatar);

            $manager->persist($user);
            $users[] = $user;
        }


        // Pays de base
        $countrys = [];
        $country = new Country();
        $country->setName('France')
                ->setCode('FR');
        $manager->persist($country);
        $countrys[] = $country;

        // Région de base
        $regions = [];
        $region = new Region();
        $region->setName('Grand-Est')
               ->setCountry($countrys[0]);
        $manager->persist($region);
        $regions[] = $region;

        // Département de base
        $departments = [];
        $department = new Department();
        $department->setName('Bas-Rhin')
                   ->setCode('67')
                   ->setRegion($regions[0]);
        $manager->persist($department);
        $departments[] = $department;

        // Arrondissement de base
        $boroughs = [];
        $borough = new Borough();
        $borough->setName('Strasbourg')
                ->setResident('strasbourgeois')
                ->setChiefTown('Strasbourg')
                ->setDepartment($departments[0]);
        $manager->persist($borough);
        $boroughs[] = $borough;

        // Ville de base
        $citys = [];
        $city = new City();
        $description = '<p>' . join('</p><p>' , $faker->paragraphs(5)) . '</p>';
        $coatOfArms = $faker->imageUrl(500,500);
        $city->setName('Strasbourg')
             ->setDescription($description)
             ->setCoatOfArms($coatOfArms)
             ->setBorough($boroughs[0]);
        $manager->persist($city);
        $citys[] = $city;

        // Code postaux de base
        $postcode = new Postcode();
        $postcode->setCode('67000')
                 ->setCity($citys[0]);
        $manager->persist($postcode);

        $postcode = new Postcode();
        $postcode->setCode('67100')
                 ->setCity($citys[0]);
        $manager->persist($postcode);

        $postcode = new Postcode();
        $postcode->setCode('67200')
                 ->setCity($citys[0]);
        $manager->persist($postcode);



        // Pays
        for ($i = 1; $i <= 100; $i++){

            $country = new Country();

            $name = $faker->country();
            $code = $faker->countryCode();

            $country->setName($name)
                    ->setCode($code);

            $manager->persist($country);
            $countrys[] = $country;
        }

        // Régions
        for ($i = 1; $i <= 100; $i++){

            $region = new Region();

            $name = $faker->region();
            
            if (mt_rand(0,1)){
                $country = $countrys[0];
            } else {
                $country = $countrys[mt_rand(1, count($countrys) - 1)];
            }

            $region ->setName($name)
                    ->setCountry($country);

            $manager->persist($region);
            $regions[] = $region;
        }

        // Départements
        for ($i = 1; $i <= 100; $i++){

            $department = new Department();

            $departmentTab = $faker->department();
            foreach ($departmentTab as $k => $v) {
                $code = $k;
                $name = $v;
            }

            if (mt_rand(0,1)){
                $region = $regions[0];
            } else {
                $region = $regions[mt_rand(1, count($regions) - 1)];
            }

            $department ->setName($name)
                        ->setCode($code)
                        ->setRegion($region);

            $manager->persist($department);
            $departments[] = $department;
        }

        // Arrondissements
        for ($i = 1; $i <= 10; $i++){

            $borough = new Borough();

            $name = $faker->city();
            $resident = $name . "eois";
            $chiefTown = $name;

            if (mt_rand(0,1)){
                $department = $departments[0];
            } else {
                $department = $departments[mt_rand(1, count($departments) - 1)];
            }

            $borough->setName($name)
                    ->setResident($resident)
                    ->setChiefTown($chiefTown)
                    ->setDepartment($department);

            $manager->persist($borough);
            $boroughs[] = $borough;
        }

        // Villes
        for ($i = 1; $i <= 30; $i++){

            $city = new City();

            $name = $faker->city();
            $description = '<p>' . join('</p><p>' , $faker->paragraphs(5)) . '</p>';
            $coatOfArms = $faker->imageUrl(500,500);
            if (mt_rand(0,1)){
                $borough = $boroughs[0];
            } else {
                $borough = $boroughs[mt_rand(1, count($boroughs) - 1)];
            }

            $city->setName($name)
                 ->setDescription($description)
                 ->setCoatOfArms($coatOfArms)
                 ->setBorough($borough);

            $manager->persist($city);
            $citys[] = $city;
        }
 
        // Codes postaux
        for ($i = 1; $i <= 50; $i++){

            $postcode = new Postcode();

            $city = $citys[mt_rand(1, count($citys) - 1)];
            $code = $faker->postcode();

            $postcode->setCode($code)
                     ->setCity($city);

            $manager->persist($postcode);
        }
 
        // Quartiers
        $districts = [];
        for ($i = 1; $i <= 30; $i++){

            $district = new District();

            $name = $faker->words(2);
            $name = $name[0].' '.$name[1];
            $name = ucwords($name);
            $description = '<p>' . join('</p><p>' , $faker->paragraphs(5)) . '</p>';

            if (mt_rand(0,1)){
                $city = $citys[0];
            } else {
                $city = $citys[mt_rand(1, count($citys) - 1)];
            }

            $district->setName($name)
                     ->setDescription($description)
                     ->setCity($city);

            $manager->persist($district);
            $districts[] = $district;
        }

        // Types de lieu
        $types = [
            'Bar' => 'Les bars',
            'Salle de concert' => 'Les salles de concert',
            'Boîte de nuit' => 'Les boîtes de nuit',
            'Théâtre' => 'Les théâtres',
            'Salle d’exposition' => 'Les salles d’exposition',
            'Manifestation' => 'Les manifestations citoyennes',
            'Equipement sportif' => 'Les équipements sportifs'
        ];
        $placetypes = [];

        foreach ($types as $k => $v) {

            $name = $k;
            $plural = $v;

            $placetype = new Placetype();

            $placetype  ->setName($name)
                        ->setPlural($plural);

            $manager->persist($placetype);
            $placetypes[] = $placetype;
        }

        // Lieux
        $places = [];
        $pronouns = ['Le','La','Les','Aux','Au','The','L’'];
            
        for ($i = 1; $i <= 100; $i++){

            $place = new Place();

            $name = ucfirst($faker->word());
            if (mt_rand(0,1)){
                $pronoun = $pronouns[mt_rand(0, count($pronouns) - 1)];
                if ($pronoun == 'L’'){$separator = '';} else {$separator = ' ';}
                $title = $pronoun .''. $separator .''. $name;
            } else {
                $pronoun = NULL;
                $title = $name;
            }
            
            $coverSite = "https://picsum.photos";
            if (mt_rand(0,1)){
                //$coverImage = $faker->imageUrl(1000,350);
                $widthImage = mt_rand(800,1000);
                $heightImage = mt_rand(300,500);
            } elseif (mt_rand(0,1)){
                //$coverImage = $faker->imageUrl(1000,1200);
                $widthImage = mt_rand(800,1200);
                $heightImage = mt_rand(1200,1400);
            } else {
                //$coverImage = $faker->imageUrl(500,1000);
                $widthImage = mt_rand(400,600);
                $heightImage = mt_rand(1100,1200);
            }
            $coverImage = $coverSite . '/' . $widthImage . '/' . $heightImage;


            $description = '<p>' . join('</p><p>' , $faker->paragraphs(5)) . '</p>';

            if (mt_rand(0,1)){
                $city = $citys[0];
            } else {
                $city = $citys[mt_rand(1, count($citys) - 1)];
            }

            if (mt_rand(0,1)){$district = $districts[mt_rand(0, count($districts) - 1)];} else {$district = NULL;}

            $latitude = $faker->latitude($min = 41, $max = 51);
            $longitude = $faker->longitude($min = -2, $max = 8);
            $number = $faker->buildingNumber();
            $address = $faker->streetName();
            

            $place  ->setTitle($title)
                    ->setCoverImage($coverImage)
                    ->setDescription($description)
                    ->setCity($city)
                    ->setDistrict($district)
                    ->setLatitude($latitude)
                    ->setLongitude($longitude)
                    ->setPronoun($pronoun)
                    ->setName($name)
                    ->setNumber($number)
                    ->setAddress($address);

            // Types d'un lieu
            for ($j = 1; $j <= mt_rand(0,3); $j++){
                $placetype = $placetypes[mt_rand(0, count($placetypes) - 1)];
                $place  ->addPlacetype($placetype);
                
                $manager->persist($place);
            }

            $manager->persist($place);
            $places[] = $place;
        }
 
        // Festivals
        $festivals = [];

        for ($i = 1; $i <= 10; $i++){

            $festival = new Festival();

            $title = $faker->words(2);
            $title = $title[0].' '.$title[1];
            //$slug = $slugify->slugify($title);
            //$coverImage = $faker->imageUrl(1000,350);
            $coverSite = "https://picsum.photos";
            if (mt_rand(0,1)){
                //$coverImage = $faker->imageUrl(1000,350);
                $widthImage = mt_rand(800,1000);
                $heightImage = mt_rand(300,500);
            } elseif (mt_rand(0,1)){
                //$coverImage = $faker->imageUrl(1000,1200);
                $widthImage = mt_rand(800,1200);
                $heightImage = mt_rand(1200,1400);
            } else {
                //$coverImage = $faker->imageUrl(500,1000);
                $widthImage = mt_rand(400,600);
                $heightImage = mt_rand(1100,1200);
            }
            $coverImage = $coverSite . '/' . $widthImage . '/' . $heightImage;
            $description = '<p>' . join('</p><p>' , $faker->paragraphs(5)) . '</p>';
            $festival->setTitle($title)
                //->setSlug($slug)
                ->setCoverImage($coverImage)
                ->setDescription($description);

            $manager->persist($festival);
            $festivals[] = $festival;
        }
 
        // Rubriques
        $rubrics = [
            'Concert' => 'Les concerts',
            'Soirée' => 'Les soirées',
            'Théâtre' => 'Les pièces de théâtre',
            'Exposition' => 'Les expositions',
            'Action citoyenne' => 'Les manifestations citoyennes',
            'Danse' => 'Les évènements dansants',
            'Musique classique' => 'Les concerts de musique classique',
            'Sport' => 'Les évènements sportifs',
            'Autre' => 'Les évènements inclassables'
        ];
        $tabRubrics = [];
        
        foreach ($rubrics as $k => $v) {

            $name = $k;
            $plural = $v;

            $rubric = new Rubric();

            $rubric ->setName($name)
                    ->setPlural($plural);

            $manager->persist($rubric);
            $tabRubrics[] = $rubric;
        }

        // Categories
        $categorys = [];

        for ($i = 1; $i <= 30; $i++){
            $category = new Category();

            $name = $faker->word();
            $rubric = $tabRubrics[mt_rand(0, count($tabRubrics) - 1)];

            $category   ->setName($name)
                        ->addRubric($rubric);

            $manager->persist($category);
            $categorys[] = $category;
        }
                
        // Réductions
        $reductions = ['Carte culture','Carte Atout Voir', 'Tarif jeune public'];
        $tabReductions = [];

        foreach ($reductions as $title) {

            $reduction = new Reduction();

            $reduction  ->setTitle($title);

            // Arrondissement par reduction
             for ($j = 1; $j <= mt_rand(8,10); $j++){
                $borough = $boroughs[mt_rand(0, count($boroughs) - 1)];
                $reduction->addBorough($borough);
                
                $manager->persist($reduction);
            }


            $manager->persist($reduction);
            $tabReductions[] = $reduction;
        }

        // Categories
        $categorys = [];

        for ($i = 1; $i <= 30; $i++){
            $name = $faker->word();
            $category = new Category();

            $category->setName($name);

            $manager->persist($category);
            $categorys[] = $category;
        }

        // Plateforme Vidéos
        $tab = [
            'Youtube' => ['https://www.youtube.com' => 'https://www.youtube.com/embed/'],
            'Vimeo' => ['https://vimeo.com/fr' => 'https://player.vimeo.com/video/'],
            'Dailymotion' => ['https://www.dailymotion.com' => 'https://www.dailymotion.com/embed/video/']
        ];
        $videostores = [];

        foreach ($tab as $k => $v) {
            $videostore = new Videostore();

            $name = $k;
            foreach ($v as $x => $y) {
                $website = $x;
                $embed = $y;
            }
            $videostore  ->setName($name)
                            ->setWebsite($website)
                            ->setEmbed($embed);

            $manager->persist($videostore);
            $videostores[] = $videostore;
        }

        // Billetteries
        $tab = [
            'Fnac' => ['https://www.fnac.com' => null],
            'Ticketmaster' => ['https://www.ticketmaster.fr/' => null],
            'Digitick' => ['https://www.dailymotion.com' => 'https://www.dailymotion.com/embed/video/']
        ];
        $ticketings = [];

        foreach ($tab as $k => $v) {
            $ticketing = new Ticketing();

            $name = $k;
            foreach ($v as $x => $y) {
                $website = $x;
                $embed = $y;
            }
            $ticketing ->setName($name)
                            ->setWebsite($website)
                            ->setEmbed($embed)
                            ->setSetting(1);

            $manager->persist($ticketing);
            $ticketings[] = $ticketing;
        }


        // Evènements
        for ($i = 1; $i <= 200; $i++){

            $event = new Event();

            $title = $faker->sentence();
            //$slug = $slugify->slugify($title);

            //$coverImage = $faker->imageUrl(1000,350);
            

            $description = '<p>' . join('</p><p>' , $faker->paragraphs(5)) . '</p>';

            $coverSite = "https://picsum.photos";
            if (mt_rand(0,1)){
                //$coverImage = $faker->imageUrl(1000,350);
                $widthImage = mt_rand(800,1000);
                $heightImage = mt_rand(300,500);
            } elseif (mt_rand(0,1)){
                //$coverImage = $faker->imageUrl(1000,1200);
                $widthImage = mt_rand(800,1200);
                $heightImage = mt_rand(1200,1400);
            } else {
                //$coverImage = $faker->imageUrl(500,1000);
                $widthImage = mt_rand(400,600);
                $heightImage = mt_rand(1100,1200);
            }
            $coverImage = $coverSite . '/' . $widthImage . '/' . $heightImage;
            
            if (mt_rand(0,1)){
                $user = null;
            } elseif (mt_rand(0,1)){
                $user = $users[0];
            } else {
                $user = $users[mt_rand(0, count($users) - 1)];
            }
            
            if (rand(0,1)){
                $place = $places[mt_rand(0, count($places) - 1)];
                $city = NULL;
                $placeTemporary = NULL;
            } else {
                $place = NULL;
                $city = $citys[mt_rand(0, count($citys) - 1)];
                $placeTemporary = $faker->word();
            }
            if (rand(0,1)){$festival = $festivals[mt_rand(0, count($festivals) - 1)];} else {$festival = NULL;}

            $dateStart = $faker->dateTimeBetween('-5 days','+10 days');
            
            $duration = mt_rand(0,3);
            $dateEnd = (clone $dateStart)->modify("+$duration days");

            if (rand(0,1)){
                $hourStart = mt_rand(10, 24);
                if (rand(0,1)){$minuteStart="00";}
                elseif (rand(0,1)){$minuteStart="45";}
                else {$minuteStart="30";}
                $timeStart = $hourStart.":".$minuteStart.":00";
                $timeStart = \DateTime::createFromFormat('H:i:s', $timeStart);
                if (rand(0,1)){
                    $duration = mt_rand(1,6);
                    $hourEnd = $hourStart + $duration;
                    if ($hourEnd>24){$hourEnd=$hourEnd-24;}
                    $timeEnd = $hourEnd.":00:00";
                    $timeEnd = \DateTime::createFromFormat('H:i:s', $timeEnd);
                } else {
                    $timeEnd = NULL;
                }
            } else {
                $timeStart = NULL;
                $timeEnd = NULL;
            }
            
            
            if (rand(0,1)) {
                $price = mt_rand(0,19);
                if (rand(0,1)){$price .= ".50";}
            } elseif (rand(0,1)) {
                $price = 0;
            } elseif (rand(0,1)) {
                $price = 0.01;
            } elseif (rand(0,1)) {
                $price = 22;
            } elseif (rand(0,1)) {
                $price = 21;
            } else {
                $price = 20;
            }

            $rubric = $tabRubrics[mt_rand(0, count($tabRubrics) - 1)];

            // Association de catégories avec un évènement
            for ($j = 1; $j <= mt_rand(0,3); $j++){
                $event->addCategory($categorys[mt_rand(0, count($categorys) - 1)]);
            }

            $event->setTitle($title)
                //->setSlug($slug)
                ->setDateStart($dateStart)
                ->setDateEnd($dateEnd)
                ->setTimeStart($timeStart)
                ->setTimeEnd($timeEnd)
                ->setCoverImage($coverImage)
                ->setDescription($description)
                ->setPrice($price)
                ->setAuthor($user)
                ->setPlace($place)
                ->setFestival($festival)
                ->setRubric($rubric)
                ->setCity($city)
                ->setPlaceTemporary($placeTemporary);


            // Billets
            if ($price > 6 && $price < 22){
                for ($j = 1; $j <= mt_rand(0,3); $j++){
                    $tickets = new Ticket();

                    $url = $faker->url();
                    if ($price == 21) {$price = mt_rand(21,60);}
                    elseif ($price > 6 && $price < 21) {$price = $price - 1.80;}
                    $ticketing = $ticketings[mt_rand(0, count($ticketings) - 1)];

                    $tickets ->setUrl($url)
                            ->setPrice($price)
                            ->setEvent($event)
                            ->setTicketing($ticketing);
                    
                    $manager->persist($tickets);
                }
            }

            // Tarifs réduits d'un évènement
            if ($price > 6 && $price < 22){
                for ($j = 1; $j <= mt_rand(0,4); $j++){
                    $prices = new Prices();

                    if ($price == 21) {
                        $price = mt_rand(21,60);
                    }
                    elseif ($price > 6 && $price < 21) {
                        $price = $price - 1.80;
                    }
                    $reduction = $tabReductions[mt_rand(0, count($tabReductions) - 1)];

                    $prices ->setPrice($price)
                            ->setEvent($event)
                            ->setReduction($reduction);
                    
                    $manager->persist($prices);
                }
            }

            // Images d'un évènement
            for ($j = 1; $j <= mt_rand(2,5); $j++){
                $image = new Image();

                $image  ->setUrl($faker->imageUrl())
                        ->setCaption($faker->sentence())
                        ->setEvent($event);
                
                $manager->persist($image);
            }

            // Vidéos d'un évènement
            $youtubeIds = ['c10SJto6oqk','Leienp-spqc','BtyHYIpykN0','k489OfT29BE','zp9Da20n0_k','W-gmIG41dGA','3egagRvougI','xZx3LDukUdA','IILAfcHbe8U','c10SJto6oqk','39y8RWATD04','Dab4EENTW5I','cb8rr6gHeUQ','Jb4uXBJgrys','gwQ2EuN7lpc'];
            
            for ($j = 1; $j <= mt_rand(0,4); $j++){
                $video = new Video();

                $videoUrl = 'https://www.youtube.com/watch?v=';
                $videoUrl .= $youtubeIds[mt_rand(0, count($youtubeIds) - 1)];
                $videostore = $videostores[mt_rand(0, count($videostores) - 1)];

                $video  ->setUrl($videoUrl)
                        ->setCaption($faker->sentence())
                        ->setEvent($event)
                        ->setVideostore($videostore);
                
                $manager->persist($video);
            }

            // Commentaires d'un évènement
            for ($j = 1; $j <= mt_rand(0,5); $j++){
                $comment = new Comment();

                $user2 = $users[mt_rand(0, count($users) - 1)];

                $comment ->setContent($faker->paragraph())
                         ->setRating(mt_rand(1,5))
                         ->setAuthor($user2)
                         ->setEvent($event);

                $manager->persist($comment);
            }
            
            $manager->persist($event);
        }
        $manager->flush();
    }
}
