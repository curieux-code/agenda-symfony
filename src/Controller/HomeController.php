<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    /**
     * @Route("/hello/{prenom}/taille/{taille}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_prenom")
     * Teste commentaire
     * 
     * @return void
     */
    public function hello($prenom = "anonyme", $taille = 0){
        return $this->render(
            'hello.html.twig',
            [
                'prenom' => $prenom,
                'taille' => $taille
            ]
            );
    }


        /**
         * @Route("/", name="homepage")
         */
        public function home(){

        $godmichets = [
            "saucisse" => "10",
            "vibromasseur" => "15",
            "classique" => "20"
        ];

        $domain=explode(".",$_SERVER['SERVER_NAME']);
		$subdomain=$domain[0];
		if ($subdomain=="www"){
			$website="Curieux.net";
		}
		else{
			$cityName=ucfirst(strtolower($subdomain));
			$website=$cityName." Curieux";
        }
        
        return $this->render(
            'home.html.twig',
            [
                'title' => "Bart",
                'taille' => "4",
                'tableau' => $godmichets,
                'website' => $website,
                'menuSearch' => "MENU_RUBRIC"
            ]
        );
    }
}