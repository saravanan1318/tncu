<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_log extends Model
{
    use HasFactory;
    protected $table = 'payment_log';
    protected $primaryKey = 'id';
}
