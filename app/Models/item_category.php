<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_category extends Model
{
    use HasFactory;

    protected $table='item_category';
    protected $fillable=[
        'item_id',
        'category_id'
    ];
}
