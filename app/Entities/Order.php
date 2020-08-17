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
     * @ORM\Column(type="price_type")
     */
    private Price $total_cost;

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
     * @param Price $total_cost
     */
    public function setTotalCost(Price $total_cost): void
    {
        $this->total_cost = $total_cost;
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
        $totalCost = Price::create(0);

        foreach ($this->basket as $orderItm) {
            $totalCost = $totalCost->add($orderItm->getCost());
        }

        return $totalCost;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}