<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string user_id
 * @property string document_type_id
 * @property string|null expiry_date
 * @property string front_face
 * @property string back_face
 */
class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = ['user_id','document_type_id','expiry_date','front_face','back_face'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function document_type(){
        return $this->belongsTo(DocumentType::class);
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
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUserId(string $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getDocumentTypeId(): string
    {
        return $this->document_type_id;
    }

    /**
     * @param string $document_type_id
     */
    public function setDocumentTypeId(string $document_type_id): void
    {
        $this->document_type_id = $document_type_id;
    }

    /**
     * @return string|null
     */
    public function getExpiryDate(): ?string
    {
        return $this->expiry_date;
    }

    /**
     * @param string|null $expiry_date
     */
    public function setExpiryDate(?string $expiry_date): void
    {
        $this->expiry_date = $expiry_date;
    }

    /**
     * @return string
     */
    public function getFrontFace(): string
    {
        return $this->front_face;
    }

    /**
     * @param $front_face
     */
    public function setFrontFace($front_face): void
    {
        $this->front_face = Functions::StoreImageModel($front_face,'documents');
    }

    /**
     * @return string
     */
    public function getBackFace(): string
    {
        return $this->back_face;
    }

    /**
     * @param $back_face
     */
    public function setBackFace($back_face): void
    {
        $this->back_face = Functions::StoreImageModel($back_face,'documents');
    }

}
