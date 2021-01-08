<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer id
 * @property integer user_id
 * @property integer ref_id
 * @property integer type
 * @method Favourite find(int $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Favourite extends Model
{
    protected $table = 'favourites';
    protected $fillable = ['user_id','ref_id','type'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class,'ref_id');
    }
    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class,'ref_id');
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
    public function getRefId(): int
    {
        return $this->ref_id;
    }

    /**
     * @param int $ref_id
     */
    public function setRefId(int $ref_id): void
    {
        $this->ref_id = $ref_id;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

}
