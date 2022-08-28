<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
#[UniqueEntity(
    fields: ['username'],
    message: 'This username is already used'
)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?int $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $bornOn = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\ManyToOne]
    private ?Image $profilePhoto = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Salon::class)]
    private Collection $salons;

    #[ORM\ManyToOne(inversedBy: 'managers')]
    private ?Salon $managedSalon = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    private ?Salon $workingSalon = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubscriptionPlan $subscriptionPlan = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $subscriptionPaymentDate = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: TransferAccount::class, orphanRemoval: true)]
    private Collection $transferAccounts;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Agenda $agenda = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Post::class)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable;
        $this->setSubscriptionPlan(new SubscriptionPlan);
        $this->salons = new ArrayCollection();
        $this->transferAccounts = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastName;
    }

    public function setLastname(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBornOn(): ?\DateTimeImmutable
    {
        return $this->bornOn;
    }

    public function setBornOn(\DateTimeImmutable $bornOn): self
    {
        $this->bornOn = $bornOn;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getProfilePhoto(): ?Image
    {
        return $this->profilePhoto;
    }

    public function setProfilePhoto(?Image $profilePhoto): self
    {
        $this->profilePhoto = $profilePhoto;

        return $this;
    }

    /**
     * @return Collection<int, Salon>
     */
    public function getSalons(): Collection
    {
        return $this->salons;
    }

    public function addSalon(Salon $salon): self
    {
        if (!$this->salons->contains($salon)) {
            $this->salons->add($salon);
            $salon->setOwner($this);
        }

        return $this;
    }

    public function removeSalon(Salon $salon): self
    {
        if ($this->salons->removeElement($salon)) {
            // set the owning side to null (unless already changed)
            if ($salon->getOwner() === $this) {
                $salon->setOwner(null);
            }
        }

        return $this;
    }

    public function getManagedSalon(): ?Salon
    {
        return $this->managedSalon;
    }

    public function setManagedSalon(?Salon $managedSalon): self
    {
        $this->managedSalon = $managedSalon;

        return $this;
    }

    public function getWorkingSalon(): ?Salon
    {
        return $this->workingSalon;
    }

    public function setWorkingSalon(?Salon $workingSalon): self
    {
        $this->workingSalon = $workingSalon;

        return $this;
    }

    public function getSubscriptionPlan(): ?SubscriptionPlan
    {
        return $this->subscriptionPlan;
    }

    public function setSubscriptionPlan(?SubscriptionPlan $subscriptionPlan): self
    {
        $this->subscriptionPlan = $subscriptionPlan;
        $this->subscriptionPaymentDate = new \DateTimeImmutable;

        return $this;
    }

    public function getSubscriptionPaymentDate(): ?\DateTimeImmutable
    {
        return $this->subscriptionPaymentDate;
    }

    public function setSubscriptionPaymentDate(\DateTimeImmutable $subscriptionPaymentDate): self
    {
        $this->subscriptionPaymentDate = $subscriptionPaymentDate;

        return $this;
    }

    /**
     * @return Collection<int, TransferAccount>
     */
    public function getTransferAccounts(): Collection
    {
        return $this->transferAccounts;
    }

    public function addTransferAccount(TransferAccount $transferAccount): self
    {
        if (!$this->transferAccounts->contains($transferAccount)) {
            $this->transferAccounts->add($transferAccount);
            $transferAccount->setOwner($this);
        }

        return $this;
    }

    public function removeTransferAccount(TransferAccount $transferAccount): self
    {
        if ($this->transferAccounts->removeElement($transferAccount)) {
            // set the owning side to null (unless already changed)
            if ($transferAccount->getOwner() === $this) {
                $transferAccount->setOwner(null);
            }
        }

        return $this;
    }

    public function getAgenda(): ?Agenda
    {
        return $this->agenda;
    }

    public function setAgenda(?Agenda $agenda): self
    {
        if ($agenda instanceof UserAgenda)
            $agenda->setOwner($this);

        $this->agenda = $agenda;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }
}
