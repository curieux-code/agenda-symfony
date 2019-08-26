<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks
 */

class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="category")
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Rubric", mappedBy="category")
     */
    private $rubrics;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->rubrics = new ArrayCollection();
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

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addCategory($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection|Rubric[]
     */
    public function getRubrics(): Collection
    {
        return $this->rubrics;
    }

    public function addRubric(Rubric $rubric): self
    {
        if (!$this->rubrics->contains($rubric)) {
            $this->rubrics[] = $rubric;
            $rubric->addCategory($this);
        }

        return $this;
    }

    public function removeRubric(Rubric $rubric): self
    {
        if ($this->rubrics->contains($rubric)) {
            $this->rubrics->removeElement($rubric);
            $rubric->removeCategory($this);
        }

        return $this;
    }
}
