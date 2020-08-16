<?php

namespace App\Entities;


use App\Entities\OrderItm;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @package App\Entities
 *
 * @ORM\Entity()
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="price_type")
     */
    private Price $price;

    /**
     * @ORM\OneToMany(targetEntity="OrderItm", mappedBy="product")
     * @var OrderItm[]
     */
    private array $orderItmList;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private DateTime $created_at;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $updated_at;

    /**
     * Product constructor.
     *
     * @param string   $name
     * @param Price    $price
     * @param int|null $id
     */
    public function __construct(string $name, Price $price, ?int $id = null)
    {
        $this->name  = $name;
        $this->price = $price;
        $this->id    = $id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /** @return Price */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function toArray()
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'price' => $this->price->getVal(),
        ];
    }
}