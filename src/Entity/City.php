<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 * @ORM\HasLifecycleCallbacks
 * @ApiResource
 */
class City
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coatOfArms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Place", mappedBy="city")
     */
    private $place;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\District", mappedBy="city")
     */
    private $district;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Borough", inversedBy="city")
     * @ORM\JoinColumn(nullable=false)
     */
    private $borough;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="city")
     */
    private $event;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Postcode", mappedBy="city", orphanRemoval=true)
     */
    private $postcodes;

    public function __construct()
    {
        $this->place = new ArrayCollection();
        $this->district = new ArrayCollection();
        $this->event = new ArrayCollection();
        $this->postcodes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCoatOfArms(): ?string
    {
        return $this->coatOfArms;
    }

    public function setCoatOfArms(?string $coatOfArms): self
    {
        $this->coatOfArms = $coatOfArms;

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
            $place->setCity($this);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->place->contains($place)) {
            $this->place->removeElement($place);
            // set the owning side to null (unless already changed)
            if ($place->getCity() === $this) {
                $place->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|District[]
     */
    public function getDistrict(): Collection
    {
        return $this->district;
    }

    public function addDistrict(District $district): self
    {
        if (!$this->district->contains($district)) {
            $this->district[] = $district;
            $district->setCity($this);
        }

        return $this;
    }

    public function removeDistrict(District $district): self
    {
        if ($this->district->contains($district)) {
            $this->district->removeElement($district);
            // set the owning side to null (unless already changed)
            if ($district->getCity() === $this) {
                $district->setCity(null);
            }
        }

        return $this;
    }

    public function getBorough(): ?Borough
    {
        return $this->borough;
    }

    public function setBorough(?Borough $borough): self
    {
        $this->borough = $borough;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event[] = $event;
            $event->setCity($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->event->contains($event)) {
            $this->event->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getCity() === $this) {
                $event->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Postcode[]
     */
    public function getPostcodes(): Collection
    {
        return $this->postcodes;
    }

    public function addPostcode(Postcode $postcode): self
    {
        if (!$this->postcodes->contains($postcode)) {
            $this->postcodes[] = $postcode;
            $postcode->setCity($this);
        }

        return $this;
    }

    public function removePostcode(Postcode $postcode): self
    {
        if ($this->postcodes->contains($postcode)) {
            $this->postcodes->removeElement($postcode);
            // set the owning side to null (unless already changed)
            if ($postcode->getCity() === $this) {
                $postcode->setCity(null);
            }
        }

        return $this;
    }
}
