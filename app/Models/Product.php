<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      protected $fillable = [
        'name',
        'description',
    ];

   /**

     * Get the images for the product.

     */

    public function images()
    {

        return $this->hasMany(Image::class);

    }
}
