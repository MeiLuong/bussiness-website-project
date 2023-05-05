<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'title',
        'author',
        'image',
        'category_id',
        'content'
    ];

    public function blogComments() {
        return $this->hasMany(BlogComment::class, 'D5S', 'id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
