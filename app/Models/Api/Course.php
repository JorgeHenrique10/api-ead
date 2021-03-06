<?php

namespace App\Models\Api;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $table = 'courses';
    protected $typeKey = 'uuid';
    protected $fillable = ['name', 'description', 'image'];

    public function modules()
    {
        return $this->hasMany(Module::class);
        // $this->hasMany(Module::class, 'course_id', 'id');
    }
}
