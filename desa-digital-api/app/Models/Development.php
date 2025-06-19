<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Development extends Model
{
    use HasFactory, SoftDeletes, UUID;

    protected $fillable = [
        'thumbnail',
        'name',
        'description',
        'person_in_change',
        'start_date',
        'end_date',
        'amount',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }

    public function developmentApplicants()
    {
        return $this->hasMany(DevelopmentApplicant::class);
    }
}
