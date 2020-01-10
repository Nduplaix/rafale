<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BasketLineRepository")
 */
class BasketLine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $productNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="basketLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Basket", inversedBy="basketLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $basket;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getProductNumber(): ?int
    {
        return $this->productNumber;
    }

    public function setProductNumber(int $productNumber): self
    {
        $this->productNumber = $productNumber;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): self
    {
        $this->basket = $basket;

        return $this;
    }
}
