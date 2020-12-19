<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string|null user_id
 * @property string|null status
 * @method RefundRequest find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class RefundRequest extends Model
{
    protected $table = 'refund_requests';
    protected $fillable = ['user_id','status'];

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
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->user_id;
    }

    /**
     * @param string|null $user_id
     */
    public function setUserId(?string $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

}
