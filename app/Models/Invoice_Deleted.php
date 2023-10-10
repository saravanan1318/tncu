<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice_Deleted extends Model
{
    use HasFactory;
    protected $table = 'invoice_deleted';
    protected $primaryKey = 'id';

}
