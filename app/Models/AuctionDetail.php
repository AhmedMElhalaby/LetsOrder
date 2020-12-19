<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property mixed auction_id
 * @property mixed name
 * @property mixed name_ar
 * @property mixed value
 * @property mixed value_ar
 * @method AuctionDetail find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class AuctionDetail extends Model
{
    protected $table = 'auction_details';
    protected $fillable = ['auction_id','name','name_ar','value','value_ar'];

    public function auction(){
        return $this->belongsTo(Auction::class);
    }
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
     * @return mixed
     */
    public function getAuctionId()
    {
        return $this->auction_id;
    }

    /**
     * @param mixed $auction_id
     */
    public function setAuctionId($auction_id): void
    {
        $this->auction_id = $auction_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     * @param mixed $name_ar
     */
    public function setNameAr($name_ar): void
    {
        $this->name_ar = $name_ar;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValueAr()
    {
        return $this->value_ar;
    }

    /**
     * @param mixed $value_ar
     */
    public function setValueAr($value_ar): void
    {
        $this->value_ar = $value_ar;
    }

}
