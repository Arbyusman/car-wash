<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WashTransactionDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function washTransaction()
    {
        return $this->belongsTo(WashTransaction::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
