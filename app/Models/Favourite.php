<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer auction_id
 * @property integer user_id
 * @method Favourite find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Favourite extends Model
{
    protected $table = 'favourites';
    protected $fillable = ['auction_id','user_id'];

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
     * @return int
     */
    public function getAuctionId(): int
    {
        return $this->auction_id;
    }

    /**
     * @param int $auction_id
     */
    public function setAuctionId(int $auction_id): void
    {
        $this->auction_id = $auction_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

}
