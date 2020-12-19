<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property mixed user_id
 * @property mixed auction_id
 * @property mixed price
 * @property mixed status
 * @method Bid find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Bid extends Model
{
    protected $table = 'bids';
    protected $fillable = ['user_id','auction_id','price','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }


}
