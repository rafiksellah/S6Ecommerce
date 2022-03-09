<?php

namespace App\Entity;

use App\Repository\OrdersDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersDetailsRepository::class)]
class OrdersDetails
{
   

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Orders::class, inversedBy: 'ordersDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $oredrs;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Products::class, inversedBy: 'ordersDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $Products;

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOredrs(): ?Orders
    {
        return $this->oredrs;
    }

    public function setOredrs(?Orders $oredrs): self
    {
        $this->oredrs = $oredrs;

        return $this;
    }

    public function getProducts(): ?Products
    {
        return $this->Products;
    }

    public function setProducts(?Products $Products): self
    {
        $this->Products = $Products;

        return $this;
    }
}
