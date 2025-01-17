<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;
    use HasFactory;
    
    public $sortable = ['id', 'product_name', 'price', 'stock'];
    // public $sortableAs = ['company_name'];
    // protected $fillable = ['company_id', 'product_name', 'price', 'stock', 'comment', 'img_path'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
    return $this->hasMany(Sale::class); // Productは複数のSaleを持つ
    }
    
}

