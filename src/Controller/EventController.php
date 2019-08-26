<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Image;
use App\Entity\Rubric;
use App\Form\EventType;
use App\Entity\Category;
use App\Entity\Reduction;
use App\Entity\EventSearch;
use App\Form\EventSearchType;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{



/*  Verrouillage via compte utlisateur
    * @IsGranted("ROLE_USER");
*/

    /**
     * Création annonce
     * 
     * @Route("/agenda/annoncer-un-evenement", name="event_create")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $event = new Event();
        
        /*
        Création d'un formulaire temporaire
        $image = new Image();

        $image->setUrl('http://placehold.it/400x200')
              ->setCaption('Titre 1');
        
              $image2 = new Image();

              $image2->setUrl('http://placehold.it/400x200')
                    ->setCaption('Titre 2');
              
        $event->addImage($image)
              ->addImage($image2);
        */

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            foreach($event->getImages() as $image){
                $image->setEvent($event);
                $manager->persist($image);
            }

            // inutile car Injection dépendance
            //$manager = $this->getDoctrine()->getManager();

            $event->setAuthor($this->getUser());


            $manager->persist($event);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$event->getTitle()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('event_show', [
                'slug' => $event->getSlug()
            ]);
        }

        /*
        $form = $this->createFormBuilder($event)
                ->add('title')
                ->add('description')
                ->add('price')
                ->add('coverImage')
                ->add('save', SubmitType::class, [
                    'label' => 'Créer la nouvelle annonce',
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ]
                ])
                ->getForm();
        */
        return $this->render('event/new.html.twig', [
            'form' => $form->createView()
        ]);
    }










    /**
     * @Route("/agenda/", name="event_index")
     * @return Response
     */
    public function index(EventRepository $repo, Request $request )
    {
        // Début du code à centraliser pour connaitre et afficher le sous-répertoire du site
        $domain=explode(".",$_SERVER['SERVER_NAME']);
        $subdomain=$domain[0];
        if ($subdomain=="www"){
            $website="Curieux.neto";
        }else{
            $cityName=ucfirst(strtolower($subdomain));
            $website=$cityName." Curieux";
        }
        // Fin du code à centraliser

        // Début du code à centraliser pour compter les evenements par jour
        $today = date('Y-m-d');
        $theDateOfSevenDaysAfterTomm = date('Y-m-d', strtotime('+7 days'));
        $query = "SELECT date_start,date_end FROM event where date_start <= '$theDateOfSevenDaysAfterTomm' AND  date_end >= '$today' ORDER BY date_start";
        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $events = $statement->fetchAll();
        $day[0] = array('date'=>date('Y-m-d', strtotime('+0 days')),'count'=>0);
        $day[1] = array('date'=>date('Y-m-d', strtotime('+1 days')),'count'=>0);
        $day[2] = array('date'=>date('Y-m-d', strtotime('+2 days')),'count'=>0);
        $day[3] = array('date'=>date('Y-m-d', strtotime('+3 days')),'count'=>0);
        $day[4] = array('date'=>date('Y-m-d', strtotime('+4 days')),'count'=>0);
        $day[5] = array('date'=>date('Y-m-d', strtotime('+5 days')),'count'=>0);
        $day[6] = array('date'=>date('Y-m-d', strtotime('+6 days')),'count'=>0);
        $day[7] = array('date'=>date('Y-m-d', strtotime('+7 days')),'count'=>0);
        foreach($events as $key => $event) {
            for ($i=0; $i < count($day) ; $i++) {
                // Si evenement commence, termine ou est en cours, selon le jour recherché
                if($event["date_start"] <= $day[$i]["date"] && $event["date_end"] >= $day[$i]["date"] ){
                    $day[$i]["count"]++;
                }
            }
        }

        $controller = new Controller;
        $repoRubric = $this->getDoctrine()->getRepository(Rubric::class);
        $repoReduction = $this->getDoctrine()->getRepository(Reduction::class);
        $repoCategory = $this->getDoctrine()->getRepository(Category::class);
                
        $search = new EventSearch;
        $form = $this->createForm(EventSearchType::class,$search);
        $form->handleRequest($request);
        // Fin du code à centraliser

        //$repo = $this->getDoctrine()->getRepository(Event::class);
        //$events = $repo->findBy(["dateStart"=> $date ]);
        $today = date('Y-m-d', strtotime('now'));
        $events = $repo->findAllEventsByDate($today);

        // Affichage du titre de la page selon le sous-domaine
        $texteDateSearch = "Cette semaine";
        if ($subdomain=="www"){$texteDateSearch .= " sur " . $website;}
        else {$texteDateSearch .= " à " . $cityName . " et alentours";}
        
        return $this->render('event/index.html.twig', [
            'events' => $events,
            'texteDateSearch' => $texteDateSearch,
            'countByDay' => $day,
            'daysOfWeek' => $controller->getDaysOfTheWeek(),
            'rubrics' => $controller->getRubrics($repoRubric),
            'categorys' => $controller->getCategories($repoCategory),
            'reductions' => $controller->getReductions($repoReduction),
            'form'   => $form->createView(),
            'directory' => '',
            'website' => $website,
            'menu' => ['MENU_WEEK','MENU_RUBRIC','MENU_REDUCTION','MENU_PLACE'],
        ]);
    }















    /**
     * @Route("/agenda/recherche", name="event_search")
     * @return Response
     */
    public function indexSearch(Request $request )
    {
        $search = new EventSearch();
        $form = $this->createForm(EventSearchType::class, $search);
        $form->handleRequest($request);

        $repo = $this->getDoctrine()->getRepository(Event::class);
        $events = $repo->findAllVisibleQuery($search);


        // Début du code à centraliser pour connaitre et afficher le sous-répertoire du site

        $domain=explode(".",$_SERVER['SERVER_NAME']);
        $subdomain=$domain[0];
        if ($subdomain=="www"){
            $website="Curieux.neto";
        }
        else{
            $cityName=ucfirst(strtolower($subdomain));
            $website=$cityName." Curieux";
        }

        // Fin du code à centraliser


        // Début du code à centraliser pour compter les evenements par jour
        $today = date('Y-m-d');
        $theDateOfSevenDaysAfterTomm = date('Y-m-d', strtotime('+7 days'));
        $query = "SELECT date_start,date_end FROM event where date_start <= '$theDateOfSevenDaysAfterTomm' AND  date_end >= '$today' ORDER BY date_start";
        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $events = $statement->fetchAll();
        $day[0] = array('date'=>date('Y-m-d', strtotime('+0 days')),'count'=>0);
        $day[1] = array('date'=>date('Y-m-d', strtotime('+1 days')),'count'=>0);
        $day[2] = array('date'=>date('Y-m-d', strtotime('+2 days')),'count'=>0);
        $day[3] = array('date'=>date('Y-m-d', strtotime('+3 days')),'count'=>0);
        $day[4] = array('date'=>date('Y-m-d', strtotime('+4 days')),'count'=>0);
        $day[5] = array('date'=>date('Y-m-d', strtotime('+5 days')),'count'=>0);
        $day[6] = array('date'=>date('Y-m-d', strtotime('+6 days')),'count'=>0);
        $day[7] = array('date'=>date('Y-m-d', strtotime('+7 days')),'count'=>0);
        foreach($events as $key => $event) {
            for ($i=0; $i < count($day) ; $i++) {
                // Si evenement commence, termine ou est en cours, selon le jour recherché
                if($event["date_start"] <= $day[$i]["date"] && $event["date_end"] >= $day[$i]["date"] ){
                    $day[$i]["count"]++;
                }
            }
        }

        $controller = new Controller;
        $repoRubric = $this->getDoctrine()->getRepository(Rubric::class);
        $repoReduction = $this->getDoctrine()->getRepository(Reduction::class);
        $repoCategory = $this->getDoctrine()->getRepository(Category::class);
                
        $search = new EventSearch;
        $form = $this->createForm(EventSearchType::class,$search);
        $form->handleRequest($request);
        // Fin du code à centraliser


        //$repo = $this->getDoctrine()->getRepository(Event::class);
        //$events = $repo->findBy(["dateStart"=> $date ]);
        //$today = date('Y-m-d', strtotime('now'));
        //$events = $repo->findAllEventsByDate($today);



        $texteDateSearch = "Cette semaine";
        if ($subdomain=="www"){$texteDateSearch .= " sur " . $website;}
        else {$texteDateSearch .= " à " . $cityName . " et alentours";}
        
        return $this->render('event/index.html.twig', [
            'events' => $events,
            'countByDay' => $day,
            'daysOfWeek' => $controller->getDaysOfTheWeek(),
            'rubrics' => $controller->getRubrics($repoRubric),
            'categorys' => $controller->getCategories($repoCategory),
            'reductions' => $controller->getReductions($repoReduction),
            'form'   => $form->createView(),
            'texteDateSearch' => $texteDateSearch,
            'directory' => '',
            'website' => $website,
            'menu' => ['MENU_WEEK','MENU_RUBRIC','MENU_REDUCTION','MENU_PLACE']
        ]);
    }















    /**
     * Afficher les évènements par jour
     * 
     * @Route("/agenda/{txtDay}", name="event_by_day")
     */
    public function indexDay(EventRepository $repo, Request $request, $txtDay)
    {

        // Début du code à centraliser pour connaitre et afficher le sous-répertoire du site
    
		$domain=explode(".",$_SERVER['SERVER_NAME']);
		$subdomain=$domain[0];
		if ($subdomain=="www"){
			$website="Curieux.neto";
		}
		else{
			$cityName=ucfirst(strtolower($subdomain));
			$website=$cityName." Curieux";
		}

        // Fin du code à centraliser


        // Début du code à centraliser pour compter les evenements par jour
        $today = date('Y-m-d');
        $theDateOfSevenDaysAfterTomm = date('Y-m-d', strtotime('+7 days'));
        $query = "SELECT date_start,date_end FROM event where date_start <= '$theDateOfSevenDaysAfterTomm' AND  date_end >= '$today' ORDER BY date_start";
        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $events = $statement->fetchAll();
        $day[0] = array('date'=>date('Y-m-d', strtotime('+0 days')),'count'=>0);
        $day[1] = array('date'=>date('Y-m-d', strtotime('+1 days')),'count'=>0);
        $day[2] = array('date'=>date('Y-m-d', strtotime('+2 days')),'count'=>0);
        $day[3] = array('date'=>date('Y-m-d', strtotime('+3 days')),'count'=>0);
        $day[4] = array('date'=>date('Y-m-d', strtotime('+4 days')),'count'=>0);
        $day[5] = array('date'=>date('Y-m-d', strtotime('+5 days')),'count'=>0);
        $day[6] = array('date'=>date('Y-m-d', strtotime('+6 days')),'count'=>0);
        $day[7] = array('date'=>date('Y-m-d', strtotime('+7 days')),'count'=>0);
        foreach($events as $key => $event) {
            for ($i=0; $i < count($day) ; $i++) {
                // Si evenement commence, termine ou est en cours, selon le jour recherché
                if($event["date_start"] <= $day[$i]["date"] && $event["date_end"] >= $day[$i]["date"] ){
                    $day[$i]["count"]++;
                }
            }
        }

        $controller = new Controller;
        $repoRubric = $this->getDoctrine()->getRepository(Rubric::class);
        $repoReduction = $this->getDoctrine()->getRepository(Reduction::class);
        $repoCategory = $this->getDoctrine()->getRepository(Category::class);
                
        $search = new EventSearch;
        $form = $this->createForm(EventSearchType::class,$search);
        $form->handleRequest($request);
        // Fin du code à centraliser

        $textePrecision="";
        if ($txtDay=="avant-hier"){$nbDay=-2;}
        elseif ($txtDay=="hier"){$nbDay=-1; $textePrecision="Hier";}
        elseif ($txtDay=="aujourd-hui"){$nbDay=0; $textePrecision="Aujourd'hui, ce ";}
        elseif ($txtDay=="demain"){$nbDay=1; $textePrecision="Demain, le ";}
        elseif ($txtDay=="apres-demain"){$nbDay=2; $textePrecision="Après-demain, le ";}
        elseif ($txtDay=="dans-3-jours"){$nbDay=3;}
        elseif ($txtDay=="dans-4-jours"){$nbDay=4;}
        elseif ($txtDay=="dans-5-jours"){$nbDay=5;}
        elseif ($txtDay=="dans-6-jours"){$nbDay=6;}
        elseif ($txtDay=="dans-une-semaine"){$nbDay=7;}
        else {$nbDay=0;}

        $date = date('Y-m-d', strtotime($nbDay.'days'));

        $dayOfWeek = ["dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi"];
        $month = ["décembre","janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];

        $nbWeek = date('w', strtotime($nbDay.'days'));
        $theDay = date('d', strtotime($nbDay.'days'));
        $nbMonth = date('n', strtotime($nbDay.'days'));
        $theYear = date('Y', strtotime($nbDay.'days'));
        $texteDateSearch = $textePrecision . ' ' . $dayOfWeek[$nbWeek] . ' ' . $theDay . ' ' . $month[$nbMonth] . ' ' . $theYear;

        //$events = $repo->findBy(["dateStart"=> $date ]);
        $events = $repo->findAllEventsByDate($date);
		
        return $this->render('event/index.html.twig', [
            'events' => $events,
            'directory' => $nbDay,
            'countByDay' => $day,
            'daysOfWeek' => $controller->getDaysOfTheWeek(),
            'rubrics' => $controller->getRubrics($repoRubric),
            'categorys' => $controller->getCategories($repoCategory),
            'reductions' => $controller->getReductions($repoReduction),
            'form'   => $form->createView(),
            'texteDateSearch' => $texteDateSearch,
            'website' => $website,
            'menu' => ['MENU_WEEK','MENU_RUBRIC']
        ]);
    }



    /**
     * Permet d'éditer une annonce
     * 
     * @Route("/agenda/evenement/{slug}/edit", name="event_edit")
     * @Security("is_granted('ROLE_USER') and user === event.getAuthor()", message="Vous n'avez pas le droit de modifier cette évènement")
     * @return Response
     */
    public function edit(Event $event, Request $request, ObjectManager $manager){

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            foreach($event->getImages() as $image){
                $image->setEvent($event);
                $manager->persist($image);
            }

            // inutile car Injection dépendance
            //$manager = $this->getDoctrine()->getManager();

            $manager->persist($event);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications ont été modifiée !"
            );

            return $this->redirectToRoute('event_show', [
                'slug' => $event->getSlug()
            ]);
        }

        return $this->render('event/edit.html.twig', [
            'form' => $form->createView(),
            'event' => $event
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     * 
     * @Route("/agenda/evenement/{slug}", name="event_show")
     * 
     * @return Response
     */
    public function show(Event $event){
        // function show($slug, EventRepository $repo){
        // Je récupère l'annonce qui correspond au slug
        //$event = $repo->findOneBySlug($slug);

        return $this->render('event/show.html.twig', [
            'event' => $event
        ]);
    }

    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/agenda/evenement/{slug}/delete", name="event_delete")
     * @Security("is_granted('ROLE_USER') and user === event.getAuthor()", message="Vous n'avez pas le droit de supprimer cette évènement")
     * 
     * @param Event $event
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Event $event, ObjectManager $manager){
        $manager->remove($event);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'annonce <strong>{$event->getTitle()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('event_index');
    }

}
