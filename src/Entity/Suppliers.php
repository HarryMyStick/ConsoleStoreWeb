<?php

namespace App\Entity;

use App\Repository\SuppliersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuppliersRepository::class)
 */
class Suppliers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SupplierName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SupplierNation;
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="Supplier", orphanRemoval=true)
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplierName(): ?string
    {
        return $this->SupplierName;
    }

    public function setSupplierName(string $SupplierName): self
    {
        $this->SupplierName = $SupplierName;

        return $this;
    }

    public function getSupplierNation(): ?string
    {
        return $this->SupplierNation;
    }

    public function setSupplierNation(string $SupplierNation): self
    {
        $this->SupplierNation = $SupplierNation;

        return $this;
    }

    public function addSupplier(Supplier $Supplier): self
    {
        if (!$this->Suppliers->contains($Supplier)) {
            $this->Suppliers[] = $Supplier;
            $Supplier->setIDProduct($this);
        }

        return $this;
    }

    public function removeSupplier(Supplier $Supplier): self
    {
        if ($this->Suppliers->removeElement($Supplier)) {
            // set the owning side to null (unless already changed)
            if ($Supplier->getIDProduct() === $this) {
                $Supplier->setIDProduct(null);
            }
        }

        return $this;
    }
}
