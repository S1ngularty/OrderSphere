<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;
    
    protected $table='stocks';
    protected $fillable=[
        'item_id',
      'qty'  
    ];
}
