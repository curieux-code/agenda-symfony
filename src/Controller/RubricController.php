<?php

namespace App\Controller;

use App\Entity\Rubric;
use App\Entity\Category;
use App\Entity\Reduction;
use App\Entity\EventSearch;
use App\Service\DaysOfWeek;
use App\Form\EventSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RubricController extends AbstractController
{
    /**
     * @Route("/rubrique/{slug}", name="search_by_rubric")
     */
    public function index(Rubric $rubric, Request $request, DaysOfWeek $daysofweek, $slug)
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

        //$test = $daysofweek->getInformation();
        //dump($test);
        
        //$today = date('Y-m-d', strtotime('now'));
        //$events = $repo->findAllEventsByDate($today);

        return $this->render('rubric/index.html.twig', [
            'rubric' => $rubric,
            'directory' => $slug,
            'website' => $website,
            'countByDay' => $day,
            'daysOfWeek' => $controller->getDaysOfTheWeek(),
            'rubrics' => $controller->getRubrics($repoRubric),
            'categorys' => $controller->getCategories($repoCategory),
            'reductions' => $controller->getReductions($repoReduction),
            'form'   => $form->createView(),
            'menu' => ['MENU_RUBRIC']

        ]);
    }
}
