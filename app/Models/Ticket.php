<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'customer_name',
        'email',
        'phone_number',
        'description',
        'status',
        'agent_id',
        'is_opened',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
