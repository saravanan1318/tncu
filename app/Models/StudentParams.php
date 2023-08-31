<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentParams extends Model
{
    use HasFactory;
    protected $table = 'student_params';
    protected $primaryKey = 'id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function icm() {
        return $this->hasOne('App\Models\Mtr_Icm','id','icm');
    }

}
