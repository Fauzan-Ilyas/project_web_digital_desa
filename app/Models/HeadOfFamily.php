<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class HeadOfFamily extends Model
{
    use HasFactory, SoftDeletes, UUID;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'identity_number',
        'gender',
        'date_of_birth',
        'phone_number',
        'occupation',
        'marital_status',
    ];

    // ABoy 
    public function ScopeSearch($query, $search)
    {
        return $query->whereHas('user' , function($query) use ($search){
            $query->where('name', 'like', '%'. $search. '%')
            ->orWhere('email', 'like', '%' . $search . '%');
        })->orWhere('phone_number', 'like', '%' . $search . '%')
            ->orWhere('identity_number', 'like', '%' . $search . '%');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyMember()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function socialAssistanceRecipients()
    {
        return $this->hasMany(SocialAssistanceRecipient::class);
    }

    public function eventParticipants()
    {
        return $this->hasMany(EventParticipant::class);
    }
}
