<?php

namespace App\Models\Api;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $table = 'lessons';
    protected $typeKey = 'uuid';
    protected $fillable = ['name', 'module_id', 'url', 'video', 'description'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function views()
    {
        return $this->hasMany(View::class)
            ->where(function ($query) {
                if (Auth::check()) {
                    return $query->where('user_id', Auth::user()->id);
                }
            });
    }
}
