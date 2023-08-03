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

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
