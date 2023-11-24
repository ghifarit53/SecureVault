<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;
    protected $table = 'user_request';

    protected $fillable = [
        'status',
        'sender_id',
        'target_id',
    ];

    // Define relationships
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target_id');
    }
}
