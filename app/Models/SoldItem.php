<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class SoldItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'total',
    ];

    public function item_from()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
