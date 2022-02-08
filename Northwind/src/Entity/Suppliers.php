<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\Array_;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @ORM\Entity
 * @ORM\Table(name="suppliers")
 */
class Suppliers
{
    /**
     * @ORM\Column(name="SupplierID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @ORM\Column(name="CompanyName", type="string", length=40)
     */
    private $name;
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Products", mappedBy="suppliers", orphanRemoval=true, fetch="EAGER")
     */
    private $products;

    /**
     * @ORM\Column(name="ContactName", type="string", length=30, nullable=true)
     */
    private $ContactName;

    /**
     * @ORM\Column(name="ContactTitle",type="string", length=30, nullable=true)
     */
    private $ContactTitle;

    /**
     * @ORM\Column(name="Address",type="string", length=60, nullable=true)
     */
    private $Address;

    /**
     * @ORM\Column(name="City",type="string", length=15, nullable=true)
     */
    private $City;

    /**
     * @ORM\Column(name="Region",type="string", length=15, nullable=true)
     */
    private $Region;

    /**
     * @ORM\Column(name="PostalCode",type="string", length=10, nullable=true)
     */
    private $PostalCode;

    /**
     * @ORM\Column(name="Country",type="string", length=15, nullable=true)
     */
    private $Country;

    /**
     * @ORM\Column(name="Phone",type="string", length=24, nullable=true)
     */
    private $Phone;

    /**
     * @ORM\Column(name="Fax",type="string", length=24, nullable=true)
     */
    private $Fax;

    /**
     * @ORM\Column(name="HomePage",type="text", nullable=true)
     */
    private $HomePage;
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getProducts() : Collection
    {
        return $this->products;
    }

    public function addProducts(Products $products) : self
    {
        if (!$this->products->contains($products))
        {
            $this->products[] = $products;
            $products->setSuppliers($this);
        }
        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->ContactName;
    }

    public function setContactName(?string $ContactName): self
    {
        $this->ContactName = $ContactName;

        return $this;
    }

    public function getContactTitle(): ?string
    {
        return $this->ContactTitle;
    }

    public function setContactTitle(?string $ContactTitle): self
    {
        $this->ContactTitle = $ContactTitle;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(?string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(?string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(?string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->PostalCode;
    }

    public function setPostalCode(?string $PostalCode): self
    {
        $this->PostalCode = $PostalCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(?string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(?string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->Fax;
    }

    public function setFax(?string $Fax): self
    {
        $this->Fax = $Fax;

        return $this;
    }

    public function getHomePage(): ?string
    {
        return $this->HomePage;
    }

    public function setHomePage(?string $HomePage): self
    {
        $this->HomePage = $HomePage;

        return $this;
    }
}
