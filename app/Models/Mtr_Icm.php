<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mtr_Icm extends Model
{
    use HasFactory;

    protected $table = 'mtr_icm';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
