<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $guarded = ['id'];
    protected $fillable = [        
        'date_hourly',
        'name_emitter',
        'NIT_emitter',
        'name_buyer',
        'NIT_buyer',
        'before_IVA',
        'IVA',
        'total_value',
        'quantity',
    ]; 

    public function InvoicesProducts(){
        return $this->belongsToMany(Products::class, 'invoices_products', 'id_invoice', 'id_product');
    }
}
