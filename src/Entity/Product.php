<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $label;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="array")
     */
    private $images = [];

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $itemNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeLine", mappedBy="product", orphanRemoval=true)
     */
    private $commandeLines;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BasketLine", mappedBy="product", orphanRemoval=true)
     */
    private $basketLines;

    public function __construct()
    {
        $this->commandeLines = new ArrayCollection();
        $this->basketLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getItemNumber(): ?int
    {
        return $this->itemNumber;
    }

    public function setItemNumber(int $itemNumber): self
    {
        $this->itemNumber = $itemNumber;

        return $this;
    }

    /**
     * @return Collection|CommandeLine[]
     */
    public function getCommandeLines(): Collection
    {
        return $this->commandeLines;
    }

    public function addCommandeLine(CommandeLine $commandeLine): self
    {
        if (!$this->commandeLines->contains($commandeLine)) {
            $this->commandeLines[] = $commandeLine;
            $commandeLine->setProduct($this);
        }

        return $this;
    }

    public function removeCommandeLine(CommandeLine $commandeLine): self
    {
        if ($this->commandeLines->contains($commandeLine)) {
            $this->commandeLines->removeElement($commandeLine);
            // set the owning side to null (unless already changed)
            if ($commandeLine->getProduct() === $this) {
                $commandeLine->setProduct(null);
            }
        }

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
            $basketLine->setProduct($this);
        }

        return $this;
    }

    public function removeBasketLine(BasketLine $basketLine): self
    {
        if ($this->basketLines->contains($basketLine)) {
            $this->basketLines->removeElement($basketLine);
            // set the owning side to null (unless already changed)
            if ($basketLine->getProduct() === $this) {
                $basketLine->setProduct(null);
            }
        }

        return $this;
    }
}
