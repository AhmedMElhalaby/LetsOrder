<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string name
 * @property string description
 * @property string name_ar
 * @property string description_ar
 * @property string gained_balance
 * @property string price
 * @property boolean is_active
 * @method Subscription find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $fillable = ['name','description','name_ar','description_ar','gained_balance','price','is_active'];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getNameAr(): string
    {
        return $this->name_ar;
    }

    /**
     * @param string $name_ar
     */
    public function setNameAr(string $name_ar): void
    {
        $this->name_ar = $name_ar;
    }

    /**
     * @return string
     */
    public function getDescriptionAr(): string
    {
        return $this->description_ar;
    }

    /**
     * @param string $description_ar
     */
    public function setDescriptionAr(string $description_ar): void
    {
        $this->description_ar = $description_ar;
    }

    /**
     * @return string
     */
    public function getGainedBalance(): string
    {
        return $this->gained_balance;
    }

    /**
     * @param string $gained_balance
     */
    public function setGainedBalance(string $gained_balance): void
    {
        $this->gained_balance = $gained_balance;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

}
