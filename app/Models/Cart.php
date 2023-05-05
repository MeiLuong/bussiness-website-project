<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'product_id',
        'product_qty'
    ];

    public static function getCartItems() {
        if (Auth::check()) {
            $getCartItems = Cart::with(['product'=>function($query){
                $query->select('id', 'category_id');
            }])->where('user_id', Auth::user()->id)->get()->toArray();
        }
        else {
            $getCartItems = Cart::with(['product'=>function($query){
                $query->select('id', 'category_id');
            }])->where('session_id', Session::get('session_id'))->get()->toArray();
        }

        return $getCartItems;
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
