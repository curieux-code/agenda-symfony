<?php

namespace App\Entity;

use DateTimeInterface;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

//itemOperations={"GET"={"path"="/event/{id}"}}
/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @ApiResource(
 *  collectionOperations={"GET","POST"},
 *  itemOperations={"GET","DELETE"},
 *  normalizationContext={
 *      "groups"={"events_read"}
 *  },
 *  denormalizationContext={"disable_type_enforcement"=true},
 *  attributes={
 *      "pagination_enabled"=true,
 *      "pagination_items_per_page"=5
 *  }
 * )
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *  fields={"title"},
 *  message="Un autre évènement possède déjà ce titre, merci de le modifier"
 * )
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"events_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez indiquer le titre")
     * @Assert\Length(min=10, max=255, minMessage="Le titre doit faire plus de 10 caractères !", maxMessage="Le titre doit faire maximum 255 caractères !")
     * @Groups({"events_read"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Veuillez indiquer le prix")
     * @Groups({"events_read"})
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez indiquer la description")
     * @Assert\Length(min=10, minMessage="La description doit faire plus de 10 caractères !")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     * @Groups({"events_read"})
     */
    private $coverImage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="event", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="events")
     * @Groups({"events_read"})
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="event", orphanRemoval=true)
     */
    private $comments;

    //@ApiSubresource
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="events")
     * 
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Festival", inversedBy="events")
     */
    private $festival;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="event", orphanRemoval=true)
     */
    private $videos;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /* @Assert/Date(message="La date doit être au format YYYY-MM-DD") */

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Veuillez indiquer la date de début")
     * @Groups({"events_read"})
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Veuillez indiquer la date de fin")
     * @Groups({"events_read"})
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="time", nullable=true)
     * @Groups({"events_read"})
     */
    private $timeStart;

    /**
     * @ORM\Column(type="time", nullable=true)
     * @Groups({"events_read"})
     */
    private $timeEnd;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rubric", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"events_read"})
     */
    private $rubric;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="events")
     * @Groups({"events_read"})
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="event")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $placeTemporary;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reduction", mappedBy="event")
     */
    private $reductions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prices", mappedBy="event", orphanRemoval=true)
     */
    private $prices;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="event", orphanRemoval=true)
     */
    private $tickets;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->tickets = new ArrayCollection();
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

    public function initializeDate(){
        if(empty($this->dateEnd)){
            $this->dateEnd = $this->$dateStart;
        }
    }

    /**
     * Permet d'initialiser la date de création et de mise à jour
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
    */
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTime('now'));    
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(?string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setEvent($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getEvent() === $this) {
                $image->setEvent(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getFestival(): ?Festival
    {
        return $this->festival;
    }

    public function setFestival(?Festival $festival): self
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setEvent($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getEvent() === $this) {
                $video->setEvent(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getTimeStart(): ?\DateTimeInterface
    {
        return $this->timeStart;
    }

    public function setTimeStart(?\DateTimeInterface $timeStart): self
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    public function getTimeEnd(): ?\DateTimeInterface
    {
        return $this->timeEnd;
    }

    public function setTimeEnd(?\DateTimeInterface $timeEnd): self
    {
        $this->timeEnd = $timeEnd;

        return $this;
    }

    public function getRubric(): ?Rubric
    {
        return $this->rubric;
    }

    public function setRubric(?Rubric $rubric): self
    {
        $this->rubric = $rubric;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPlaceTemporary(): ?string
    {
        return $this->placeTemporary;
    }

    public function setPlaceTemporary(?string $placeTemporary): self
    {
        $this->placeTemporary = $placeTemporary;

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
            $price->setEvent($this);
        }

        return $this;
    }

    public function removePrice(Prices $price): self
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
            // set the owning side to null (unless already changed)
            if ($price->getEvent() === $this) {
                $price->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setEvent($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getEvent() === $this) {
                $ticket->setEvent(null);
            }
        }

        return $this;
    }

}
