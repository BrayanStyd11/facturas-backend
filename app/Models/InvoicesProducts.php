<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesProducts extends Model
{
    use HasFactory;
    protected $table = 'invoices_products';
    protected $guarded = ['id'];
    protected $fillable = [
        'id_invoice',
        'id_product',
    ];

    public function products(){
        return $this->hasMany(Products::class);
    }

    public function invoices(){
        return $this->hasMany(Invoices::class);
    }
}
