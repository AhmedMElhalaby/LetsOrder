<?php

namespace App\Models;

use App\Helpers\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer id
 * @property mixed user_id
 * @property mixed provider_id
 * @property mixed amount
 * @property mixed discount_amount
 * @property mixed order_date
 * @property mixed delivered_date
 * @property mixed reject_reason
 * @property mixed cancel_reason
 * @property boolean is_finished
 * @property mixed status
 * @method Order find(mixed $order_id)
 */
class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id','provider_id','amount','discount_amount','order_date','delivered_date','reject_reason','cancel_reason','is_finished','status'];

    /**
     * @return HasMany
     */
    public function order_foods(): HasMany
    {
        return $this->hasMany(OrderFood::class);
    }
    /**
     * @return HasMany
     */
    public function order_statuses(): HasMany
    {
        return $this->hasMany(OrderStatus::class);
    }
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class,'provider_id');
    }

    /**
     * @return HasMany
     */
    public function review(): HasMany
    {
        return $this->hasMany(Review::class,'ref_id')->where('type',Constant::REVIEW_TYPE['Order']);
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
    public function getProviderId()
    {
        return $this->provider_id;
    }

    /**
     * @param mixed $provider_id
     */
    public function setProviderId($provider_id): void
    {
        $this->provider_id = $provider_id;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getDiscountAmount()
    {
        return $this->discount_amount;
    }

    /**
     * @param mixed $discount_amount
     */
    public function setDiscountAmount($discount_amount): void
    {
        $this->discount_amount = $discount_amount;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /**
     * @param mixed $order_date
     */
    public function setOrderDate($order_date): void
    {
        $this->order_date = $order_date;
    }

    /**
     * @return mixed
     */
    public function getDeliveredDate()
    {
        return $this->delivered_date;
    }

    /**
     * @param mixed $delivered_date
     */
    public function setDeliveredDate($delivered_date): void
    {
        $this->delivered_date = $delivered_date;
    }

    /**
     * @return mixed
     */
    public function getRejectReason()
    {
        return $this->reject_reason;
    }

    /**
     * @param mixed $reject_reason
     */
    public function setRejectReason($reject_reason): void
    {
        $this->reject_reason = $reject_reason;
    }

    /**
     * @return mixed
     */
    public function getCancelReason()
    {
        return $this->cancel_reason;
    }

    /**
     * @param mixed $cancel_reason
     */
    public function setCancelReason($cancel_reason): void
    {
        $this->cancel_reason = $cancel_reason;
    }

    /**
     * @return bool
     */
    public function isIsFinished(): bool
    {
        return $this->is_finished;
    }

    /**
     * @param bool $is_finished
     */
    public function setIsFinished(bool $is_finished): void
    {
        $this->is_finished = $is_finished;
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
