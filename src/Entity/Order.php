<?php

namespace App\Entity;

use App\Enum\Order1; // Import de l'énumération Order1
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $createAT = null;

    #[ORM\Column(enumType: Order1::class)] 
    private ?Order1 $status = null; 

    #[ORM\ManyToOne(inversedBy: 'order1')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'order1')]
    private Collection $orderitem;

    public function __construct()
    {
        $this->orderitem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreateAT(): ?string
    {
        return $this->createAT;
    }

    public function setCreateAT(string $createAT): static
    {
        $this->createAT = $createAT;

        return $this;
    }

    public function getStatus(): ?Order1 
    {
        return $this->status;
    }

    public function setStatus(Order1 $status): static 
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    
    public function getOrderitem(): Collection
    {
        return $this->orderitem;
    }

    public function addOrderitem(OrderItem $orderitem): static
    {
        if (!$this->orderitem->contains($orderitem)) {
            $this->orderitem->add($orderitem);
            $orderitem->setOrder1($this);
        }

        return $this;
    }

    public function removeOrderitem(OrderItem $orderitem): static
    {
        if ($this->orderitem->removeElement($orderitem)) {
            if ($orderitem->getOrder1() === $this) {
                $orderitem->setOrder1(null);
            }
        }

        return $this;
    }
}
