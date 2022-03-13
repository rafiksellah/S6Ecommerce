<?php

namespace App\Entity;

use App\Repository\CouponsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Trait\CreatedAtTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponsRepository::class)]
class Coupons
{
    use CreatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 10, unique: true)]
    private $code;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $discount;

    #[ORM\Column(type: 'integer')]
    private $max_usage;

    #[ORM\Column(type: 'datetime')]
    private $validity;

    #[ORM\Column(type: 'boolean')]
    private $is_valide;


    #[ORM\ManyToOne(targetEntity: CouponsTypes::class, inversedBy: 'coupons')]
    #[ORM\JoinColumn(nullable: false)]
    private $coupons_types;

    #[ORM\OneToMany(mappedBy: 'coupons', targetEntity: Orders::class)]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getMaxUsage(): ?int
    {
        return $this->max_usage;
    }

    public function setMaxUsage(int $max_usage): self
    {
        $this->max_usage = $max_usage;

        return $this;
    }

    public function getValidity(): ?\DateTimeInterface
    {
        return $this->validity;
    }

    public function setValidity(\DateTimeInterface $validity): self
    {
        $this->validity = $validity;

        return $this;
    }

    public function getIsValide(): ?bool
    {
        return $this->is_valide;
    }

    public function setIsValide(bool $is_valide): self
    {
        $this->is_valide = $is_valide;

        return $this;
    }

    public function getCouponsTypes(): ?CouponsTypes
    {
        return $this->coupons_types;
    }

    public function setCouponsTypes(?CouponsTypes $coupons_types): self
    {
        $this->coupons_types = $coupons_types;

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Orders $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCoupons($this);
        }

        return $this;
    }

    public function removeUser(Orders $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCoupons() === $this) {
                $user->setCoupons(null);
            }
        }

        return $this;
    }
}
