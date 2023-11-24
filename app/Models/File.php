<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class File extends Model
{
    protected $fillable = [
        'filename', 'file_extension', 'user_id', 'enc_type', 'iv_encryption', 'key', 'file_base64'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
