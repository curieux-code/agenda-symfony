<?php

namespace App\Service;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;

class Paginator {
    /**
     * Nom de l'entité sur laquelle on va effectuer la pagination
     *
     * @var string
     */
    private $entityClass;

    /**
     * Le nombre d'enregistrement a récupérer
     *
     * @var integer
     */
    private $limit = 10;

    /**
     * La page sur laquelle on se trouve
     *
     * @var integer
     */
    private $currentPage = 1;
    private $manager;
    private $twig;
    private $route;

    public function __construct(ObjectManager $manager, Environment $twig, RequestStack $request) {
        $this->route = $request->getCurrentRequest()->attributes->get('_route');
        //dump($this->route);
        //dump($request);
        //die();
        $this->manager = $manager;
        $this->twig    = $twig;
    }

    public function setRoute($route) {
        $this->route = $route;

        return $this;
    }

    public function getRoute() {
        return $this->route;
    }

    public function display() {
        $this->twig->display('admin/partials/paginator.html.twig', [
            'page' => $this->currentPage,
            'pages' => $this->getPages(),
            'route' => $this->route
        ]);
    }

    public function getPages() {
        if (empty($this->entityClass)){
            throw new \Exception("Vous n'avez pas spécifié l'entité sur laquelle nous devons paginer ! Utliser la méthode setEntityClass() de votre objet Paginator !");
        }

        // Connaitre le total des enregistrements de la table
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());
        
        // Faire la division, l'arrondi et le renvoyer
        $pages = ceil($total / $this->limit);

        return $pages;
    }

    public function getData() {
        if (empty($this->entityClass)){
            throw new \Exception("Vous n'avez pas spécifié l'entité sur laquelle nous devons paginer ! Utliser la méthode setEntityClass() de votre objet Paginator !");
        }

        // Calculer l'offset
        $offset = $this->currentPage * $this->limit - $this->limit;

        //Demander à doctrine de chercher les éléments
        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findby([], [], $this->limit, $offset);

        //Renvoyer les elements
        return $data;
    }

    public function setPage($page) {
        $this->currentPage = $page;

        return $this;
    }

    public function getPage() {
        return $this->currentPage;
    }

    public function setLimit($limit) {
        $this->limit = $limit;

        return $this;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function setEntityClass($entityClass) {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getEntityClass() {
        return $this->entityClass;
    }
}