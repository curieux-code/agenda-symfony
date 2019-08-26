<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class Controller extends AbstractController{

    function getDaysOfTheWeek(){
        // Début du code à centraliser pour afficher le menu
        $week = ["dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi"];
        $dayWeek = date('w');
        //$daysOfWeek = [$week[$dayWeek], $week[$dayWeek+1], $week[$dayWeek+2], $week[$dayWeek+3], $week[$dayWeek+4], $week[$dayWeek+5], $week[$dayWeek+6], $week[$dayWeek+7]];
        return [$week[$dayWeek], $week[$dayWeek+1], $week[$dayWeek+2], $week[$dayWeek+3], $week[$dayWeek+4], $week[$dayWeek+5], $week[$dayWeek+6], $week[$dayWeek+7]];
        // Fin du code à centraliser
    }

    public function getReductions($repoReduction){
        return $repoReduction->findAll();
    }

    public  function getRubrics($repoRubric){
        return $repoRubric->findAll();
    }

    public  function getCategories($repoCategory){
        return $repoCategory->findAll();
    }

/*
    public function getCountsByDayOfTheWeek():Response
    {

        $today = date('Y-m-d');
        $theDateOfSevenDaysAfterTomm = date('Y-m-d', strtotime('+7 days'));
        $query = "SELECT * FROM event where date_start <= '$theDateOfSevenDaysAfterTomm' AND  date_end >= '$today' ORDER BY date_start";
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
                if($event["date_start"] <= $day[$i]["date"] && $event["date_end"] >= $day[$i]["date"] ){
                    $day[$i]["count"]++;
                }
            }
        }
        return $day;
    }
*/

}

