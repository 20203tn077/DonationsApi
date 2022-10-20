<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donations';

    protected $fillable = ['id', 'reference', 'amount', 'amount_paid', 'payment_status'];

    protected $hidden = ['created_at', 'updated_at'];
}
