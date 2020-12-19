<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer user_id
 * @property integer subscription_id
 * @property mixed payment_method
 * @property mixed payment_detail
 * @property integer status
 * @method UserSubscription find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class UserSubscription extends Model
{
    protected $table = 'user_subscriptions';
    protected $fillable = ['user_id','subscription_id','payment_method','payment_detail','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function subscription(){
        return $this->belongsTo(Subscription::class);
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

    /**
     * @return int
     */
    public function getSubscriptionId(): int
    {
        return $this->subscription_id;
    }

    /**
     * @param int $subscription_id
     */
    public function setSubscriptionId(int $subscription_id): void
    {
        $this->subscription_id = $subscription_id;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * @param mixed $payment_method
     */
    public function setPaymentMethod($payment_method): void
    {
        $this->payment_method = $payment_method;
    }

    /**
     * @return mixed
     */
    public function getPaymentDetail()
    {
        return $this->payment_detail;
    }

    /**
     * @param mixed $payment_detail
     */
    public function setPaymentDetail($payment_detail): void
    {
        $this->payment_detail = Functions::StoreImageModel($payment_detail,'UserSubscription');
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

}
