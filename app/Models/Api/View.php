<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class View extends Model
{
    use HasFactory;

    protected $table = 'views';
    protected $fillable = ['user_id', 'lesson_id', 'qty'];

    public function user()
    {
        return $this->belongsTo(User::class)->where(function ($query) {
            if (Auth::check()) {
                return $query->where('user_id', Auth::user()->id);
            }
        });
    }
}
