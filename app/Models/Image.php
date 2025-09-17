<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
     
      protected $fillable = [
        'name',
        'product_id',
    ];

    /**

     * Get the product that owns the images.

     */

    public function product()
    {
        return $this->belongsTo(Product::class);

    }
}
