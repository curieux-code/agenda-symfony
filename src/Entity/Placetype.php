<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlacetypeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Placetype
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plural;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Place", inversedBy="placetypes")
     */
    private $place;

    public function __construct()
    {
        $this->place = new ArrayCollection();
    }

    /**
     * Permet d'initialiser le slug
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug(){
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->name);
        }
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPlural(): ?string
    {
        return $this->plural;
    }

    public function setPlural(string $plural): self
    {
        $this->plural = $plural;

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlace(): Collection
    {
        return $this->place;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->place->contains($place)) {
            $this->place[] = $place;
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->place->contains($place)) {
            $this->place->removeElement($place);
        }

        return $this;
    }
}
