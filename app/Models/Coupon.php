<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer user_id
 * @property string code
 * @property mixed value
 * @property mixed max_use_times
 * @property mixed expire_at
 * @property boolean is_active
 * @method Coupon find(mixed $coupon_id)
 */
class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = ['user_id','code','value','max_use_times','expire_at','is_active'];

    public function user(){
        return $this->belongsTo(User::class);
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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
    public function getMaxUseTimes()
    {
        return $this->max_use_times;
    }

    /**
     * @param mixed $max_use_times
     */
    public function setMaxUseTimes($max_use_times): void
    {
        $this->max_use_times = $max_use_times;
    }

    /**
     * @return mixed
     */
    public function getExpireAt()
    {
        return $this->expire_at;
    }

    /**
     * @param mixed $expire_at
     */
    public function setExpireAt($expire_at): void
    {
        $this->expire_at = $expire_at;
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
