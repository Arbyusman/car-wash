<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class WashTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function washer(): BelongsTo
    {
        return $this->belongsTo(Washer::class);
    }

    public function washTransactionDetail(): HasOne
    {
        return $this->hasOne(WashTransactionDetail::class);
    }
}
