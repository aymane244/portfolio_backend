<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $fillable = [
        'quote_client_name',
        'quote_client_email',
        'quote_service',
        'quote_number',
    ];
}
