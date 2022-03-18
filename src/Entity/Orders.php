<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="date")
     */
    private $Delivery;

    /**
     * @ORM\Column(type="integer")
     */
    private $Total;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Status = self::STATUS_CART;
    
    /**
     * An order that is in progress, not placed yet.
     *
     * @var string
     */
    const STATUS_CART = 'cart';


    /**
     * @ORM\ManyToOne(targetEntity=Accounts::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ID_Account;

    /**
     * @ORM\OneToMany(targetEntity=Orderdetail::class, mappedBy="ID_Order", orphanRemoval=true)
     */
    private $orderdetails;

    public function __construct()
    {
        $this->orderdetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getDelivery(): ?\DateTimeInterface
    {
        return $this->Delivery;
    }

    public function setDelivery(\DateTimeInterface $Delivery): self
    {
        $this->Delivery = $Delivery;

        return $this;
    }
    public function getTotal(): ?int
    {
        return $this->Total;
    }

    public function setTotal(int $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getIDAccount(): ?Accounts
    {
        return $this->ID_Account;
    }

    public function setIDAccount(?Accounts $ID_Account): self
    {
        $this->ID_Account = $ID_Account;

        return $this;
    }

    /**
     * @return Collection<int, Orderdetail>
     */
    public function getOrderdetails(): Collection
    {
        return $this->orderdetails;
    }

    public function addOrderdetail(Orderdetail $orderdetail): self
    {
        if (!$this->orderdetails->contains($orderdetail)) {
            $this->orderdetails[] = $orderdetail;
            $orderdetail->setIDOrder($this);
        }

        return $this;
    }

    public function removeOrderdetail(Orderdetail $orderdetail): self
    {
        if ($this->orderdetails->removeElement($orderdetail)) {
            // set the owning side to null (unless already changed)
            if ($orderdetail->getIDOrder() === $this) {
                $orderdetail->setIDOrder(null);
            }
        }

        return $this;
    }
    
    public function addItem(Orderdetail $item): self
    {
        foreach ($this->getOrderdetails() as $existingItem) {
            // The item already exists, update the quantity
            if ($existingItem->equals($item)) {
                $existingItem->setQuantity(
                    $existingItem->getQuantity() + $item->getQuantity()
                );
                return $this;
            }
        }

        $this->items[] = $item;
        $item->setIDOrder($this);

        return $this;
    }

    public function removeItem(Orderdetail $item): self
    {
        foreach ($this->getOrderdetails() as $item) {
            $this->removeItem($item);
        }

        return $this;
    }

}
