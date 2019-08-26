<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BoroughRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Borough
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resident;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chiefTown;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="borough")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Department", inversedBy="borough")
     * @ORM\JoinColumn(nullable=false)
     */
    private $department;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reduction", inversedBy="boroughs")
     */
    private $reduction;

    public function __construct()
    {
        $this->city = new ArrayCollection();
        $this->reduction = new ArrayCollection();
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

    public function getResident(): ?string
    {
        return $this->resident;
    }

    public function setResident(?string $resident): self
    {
        $this->resident = $resident;

        return $this;
    }

    public function getChiefTown(): ?string
    {
        return $this->chiefTown;
    }

    public function setChiefTown(string $chiefTown): self
    {
        $this->chiefTown = $chiefTown;

        return $this;
    }

    /**
     * @return Collection|City[]
     */
    public function getCity(): Collection
    {
        return $this->city;
    }

    public function addCity(City $city): self
    {
        if (!$this->city->contains($city)) {
            $this->city[] = $city;
            $city->setBorough($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->city->contains($city)) {
            $this->city->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getBorough() === $this) {
                $city->setBorough(null);
            }
        }

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return Collection|Reduction[]
     */
    public function getReduction(): Collection
    {
        return $this->reduction;
    }

    public function addReduction(Reduction $reduction): self
    {
        if (!$this->reduction->contains($reduction)) {
            $this->reduction[] = $reduction;
        }

        return $this;
    }

    public function removeReduction(Reduction $reduction): self
    {
        if ($this->reduction->contains($reduction)) {
            $this->reduction->removeElement($reduction);
        }

        return $this;
    }
}
