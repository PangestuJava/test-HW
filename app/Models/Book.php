<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'category_id',
        'title',
    ];

    protected static function boot()
    {
        parent::boot();
        // Generate UUID before creating a new record
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isAvailableForBorrowing()
    {
        return !$this->is_borrowed;
    }
}
