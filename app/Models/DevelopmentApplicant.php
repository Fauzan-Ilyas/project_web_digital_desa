<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DevelopmentApplicant extends Model
{
    use HasFactory, SoftDeletes, UUID;

    protected $fillable = [
        'development_id',
        'user_id',
        'status',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('user', function($request) use ($search) {
            $request->where('name', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%");
        //             ->orWhere('email', 'like', "%{$search}%");
        // })->orWhereHas('development', function($request) use ($search) {
        //     $request->where('title', 'like', "%{$search}%");
        });
    }

    public function development()
    {
        return $this->belongsTo(Development::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
