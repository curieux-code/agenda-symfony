<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Department
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
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Borough", mappedBy="department")
     */
    private $borough;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="department")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    public function __construct()
    {
        $this->borough = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Borough[]
     */
    public function getBorough(): Collection
    {
        return $this->borough;
    }

    public function addBorough(Borough $borough): self
    {
        if (!$this->borough->contains($borough)) {
            $this->borough[] = $borough;
            $borough->setDepartment($this);
        }

        return $this;
    }

    public function removeBorough(Borough $borough): self
    {
        if ($this->borough->contains($borough)) {
            $this->borough->removeElement($borough);
            // set the owning side to null (unless already changed)
            if ($borough->getDepartment() === $this) {
                $borough->setDepartment(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }
}
