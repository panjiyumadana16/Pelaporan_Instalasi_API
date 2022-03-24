<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_solve extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name',
        'problem',
        'solving',
        'no_tikecing',
    ];
}
