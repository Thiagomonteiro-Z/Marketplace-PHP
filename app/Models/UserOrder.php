<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class UserOrder extends Model
{
    use HasFactory;

    protected $table = 'user_order';
    protected $fillable = [
        'reference',
        'pagseguro_status',
        'pagseguro_code',
        'store_id',
        'items',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'order_store', 'store_id', 'order_id' );
    }

}
