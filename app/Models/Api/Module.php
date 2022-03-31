<?php

namespace App\Models\Api;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $table = 'modules';
    protected $typeKey = 'uuid';
    protected $fillable = ['name'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
