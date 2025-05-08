<?php

namespace App\Models;

use App\Models\Items;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table='categories';
    protected $primaryKey='category_id';
    protected $fillable=[
        'category_name'
    ];


    public function items(){
        return $this->belongsToMany(Items::class,'item_category','category_id','item_id');
    }


}
