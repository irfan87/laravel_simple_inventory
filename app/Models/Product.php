<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'price', 'details', 'publish'];

    // since we have "yes" and "no" in our blade, PHP will convert it as a boolean - 1 / 0
    protected $cast = [
        'publish' => 'boolean'
    ];

    // don't uncomment this unless your first product have a great relationship with other table
    // protected $primaryKey = 'id';
}
