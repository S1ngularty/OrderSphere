<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Items extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='items';
    protected $primaryKey='item_id';
    protected $fillable=[
        'item_name',
        'item_price',
        'description',
        
    ];
}
