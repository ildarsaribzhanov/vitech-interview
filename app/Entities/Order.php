<?php

namespace App\Entities;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Order
 *
 * @package App\Entities
 *
 * @ORM\Entity()
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id;

    /**
     * @ORM\Column(
     *     name="total_cost",
     *     type="price_type")
     */
    private Price $totalCost;

    /**
     * @ORM\Column(type="string", options={"default":"NEW"})
     */
    private $status = "NEW";

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     * @var DateTime
     */
    private DateTime $created_at;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     * @var DateTime
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="OrderItm",
     *     mappedBy="order",
     *     cascade={ "persist", "remove" },
     *     orphanRemoval=TRUE,
     *     fetch="EXTRA_LAZY"
     * )
     * @var OrderItm[]|ArrayCollection
     */
    private $basket = [];

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     */
    private User $user;

    /**
     * Order constructor.
     *
     * @param int|null $id
     */
    public function __construct(?int $id = null)
    {
        $this->id         = $id;
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param Price $totalCost
     */
    public function setTotalCost(Price $totalCost): void
    {
        $this->totalCost = $totalCost;
    }

    /**
     * @param Product $product
     * @param int     $count
     */
    public function addProduct(Product $product, int $count)
    {
        $productId = $product->getId();

        if (!isset($this->basket[$productId])) {
            $this->basket[$productId] = new OrderItm($product, 0);
        }

        $this->basket[$productId]->add($count);
    }

    /**
     * @return Price
     */
    public function getTotalCost(): Price
    {
        return $this->totalCost;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->status == 'PAID';
    }

    /**
     * Change status to Paid
     */
    public function setPaid(): void
    {
        $this->status = 'PAID';
    }
}