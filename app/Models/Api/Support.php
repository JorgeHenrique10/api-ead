<?php

namespace App\Models\Api;

use App\Models\Traits\UuidTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $table = 'supports';
    protected $typeKey = 'uuid';
    protected $fillable = ['description', 'status', 'lesson_id', 'user_id'];

    public $statusOptions = [
        'P' => 'Pendente, Aguardando Professor',
        'A' => 'Aguardando Aluno',
        'C' => 'Finalizado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function replies()
    {
        return $this->hasMany(ReplySupport::class);
    }
}
