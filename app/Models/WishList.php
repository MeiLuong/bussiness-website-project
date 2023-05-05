<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;

    protected $table = 'wishlist';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
