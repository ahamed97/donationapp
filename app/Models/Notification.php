<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['id','title','description','user_id','donation_id','is_read'];

    protected $visible = ['id','title','description','user_id','donation_id','is_read','created_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
