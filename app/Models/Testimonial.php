<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'description', 'star',
    ];

    public function getCensoredUsernameAttribute()
    {
        $username = $this->username;

        if (strlen($username) <= 5) {
            return str_pad(substr($username, 0, 1), strlen($username), '*');
        }

        $firstString  = substr($username, 0, 2);
        $secondString = substr($username, strlen($username) - 2, strlen($username));

        echo $firstString . str_repeat('*', strlen($username) - 4) . $secondString;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
