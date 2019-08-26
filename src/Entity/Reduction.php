<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReductionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Reduction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prices", mappedBy="reduction", orphanRemoval=true)
     */
    private $prices;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Borough", mappedBy="reduction")
     */
    private $boroughs;


    public function __construct()
    {
        $this->prices = new ArrayCollection();
        $this->boroughs = new ArrayCollection();
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
            $this->slug = $slugify->slugify($this->title);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    /**
     * @return Collection|Prices[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Prices $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setReduction($this);
        }

        return $this;
    }

    public function removePrice(Prices $price): self
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
            // set the owning side to null (unless already changed)
            if ($price->getReduction() === $this) {
                $price->setReduction(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Borough[]
     */
    public function getBoroughs(): Collection
    {
        return $this->boroughs;
    }

    public function addBorough(Borough $borough): self
    {
        if (!$this->boroughs->contains($borough)) {
            $this->boroughs[] = $borough;
            $borough->addReduction($this);
        }

        return $this;
    }

    public function removeBorough(Borough $borough): self
    {
        if ($this->boroughs->contains($borough)) {
            $this->boroughs->removeElement($borough);
            $borough->removeReduction($this);
        }

        return $this;
    }
    
}
