<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property mixed category_id
 * @property mixed city_id
 * @property mixed name
 * @property mixed description
 * @property mixed lat
 * @property mixed lng
 * @property mixed price
 * @property mixed minimum_bid
 * @property mixed code
 * @property mixed end_at
 * @property mixed terms_conditions
 * @property mixed start_at
 * @property mixed status
 * @property mixed is_advertisement
 * @method Auction find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Auction extends Model
{
    protected $table = 'auctions';
    protected $fillable = ['category_id','city_id','name','description','lat','lng','price','minimum_bid','code','end_at','terms_conditions','start_at','status','is_advertisement'];

    public function media(){
        return $this->hasMany(Media::class,'ref_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function auction_details(){
        return $this->hasMany(AuctionDetail::class,'auction_id');
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function bids(){
        return $this->hasMany(Bid::class)->orderBy('created_at','desc');
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
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * @param mixed $city_id
     */
    public function setCityId($city_id): void
    {
        $this->city_id = $city_id;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param mixed $lng
     */
    public function setLng($lng): void
    {
        $this->lng = $lng;
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
    public function getMinimumBid()
    {
        return $this->minimum_bid;
    }

    /**
     * @param mixed $minimum_bid
     */
    public function setMinimumBid($minimum_bid): void
    {
        $this->minimum_bid = $minimum_bid;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getEndAt()
    {
        return $this->end_at;
    }

    /**
     * @param mixed $end_at
     */
    public function setEndAt($end_at): void
    {
        $this->end_at = $end_at;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getTermsConditions()
    {
        return $this->terms_conditions;
    }

    /**
     * @param mixed $terms_conditions
     */
    public function setTermsConditions($terms_conditions): void
    {
        $this->terms_conditions = $terms_conditions;
    }

    /**
     * @return mixed
     */
    public function getStartAt()
    {
        return $this->start_at;
    }

    /**
     * @param mixed $start_at
     */
    public function setStartAt($start_at): void
    {
        $this->start_at = $start_at;
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

    /**
     * @return mixed
     */
    public function getIsAdvertisement()
    {
        return $this->is_advertisement;
    }

    /**
     * @param mixed $is_advertisement
     */
    public function setIsAdvertisement($is_advertisement): void
    {
        $this->is_advertisement = $is_advertisement;
    }

}
