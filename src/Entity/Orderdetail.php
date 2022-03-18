<?php

namespace App\Entity;

use App\Repository\OrderdetailRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrderdetailRepository::class)
 */
class Orderdetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderRef;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="orderdetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ID_Product;

    /**
     * @ORM\Column(type="integer")
     */
    private $Price;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1)
     */
    private $Quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $Total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderRef(): ?Orders
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Orders $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    public function getIDProduct(): ?Products
    {
        return $this->ID_Product;
    }

    public function setIDProduct(?Products $ID_Product): self
    {
        $this->ID_Product = $ID_Product;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }
    

      /**
     * Calculates the item total.
     * @return float|int
     */
    public function getTotal(): float
    {
        return $this->getIDProduct()->getPrice() * $this->getQuantity();
    }

    public function setTotal(int $Total): self
    {
        $this->Total = $Total;

        return $this;
    }
    /**
     * Tests if the given item given corresponds to the same order item.
     * @param Orderdetail $item
     * @return bool
     */
    public function equals(Orderdetail $item): bool
    {
        return $this->getIDProduct()->getId() === $item->getIDProduct()->getId();
    }


}

