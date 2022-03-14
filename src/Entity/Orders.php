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
     * @ORM\Column(type="string", length=255)
     */
    private $Delivery;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="integer")
     */
    private $Total;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Status;

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

    public function getDelivery(): ?string
    {
        return $this->Delivery;
    }

    public function setDelivery(string $Delivery): self
    {
        $this->Delivery = $Delivery;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

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
}
