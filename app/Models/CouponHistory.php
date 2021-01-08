<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property mixed order_id
 * @property mixed coupon_id
 * @property mixed user_id
 */
class CouponHistory extends Model
{
    protected $table = 'coupons_history';
    protected $fillable = ['order_id','coupon_id','user_id'];

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
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     */
    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @return mixed
     */
    public function getCouponId()
    {
        return $this->coupon_id;
    }

    /**
     * @param mixed $coupon_id
     */
    public function setCouponId($coupon_id): void
    {
        $this->coupon_id = $coupon_id;
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

}
