<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BasketRepository")
 */
class Basket
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
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="basket", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BasketLine", mappedBy="basket", orphanRemoval=true)
     */
    private $basketLines;

    public function __construct()
    {
        $this->basketLines = new ArrayCollection();
    }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|BasketLine[]
     */
    public function getBasketLines(): Collection
    {
        return $this->basketLines;
    }

    public function addBasketLine(BasketLine $basketLine): self
    {
        if (!$this->basketLines->contains($basketLine)) {
            $this->basketLines[] = $basketLine;
            $basketLine->setBasket($this);
        }

        return $this;
    }

    public function removeBasketLine(BasketLine $basketLine): self
    {
        if ($this->basketLines->contains($basketLine)) {
            $this->basketLines->removeElement($basketLine);
            // set the owning side to null (unless already changed)
            if ($basketLine->getBasket() === $this) {
                $basketLine->setBasket(null);
            }
        }

        return $this;
    }
}
