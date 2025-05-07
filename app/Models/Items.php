<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Stocks;
use App\Models\item_category;
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

    public function category(){
        return $this->belongsToMany(Category::class,'item_category','item_id','category_id');
    }
}
