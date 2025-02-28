<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserAuditable
{
    public static function bootUserAuditable()
    {
        static::creating(function ($model) {
            $user = Auth::user();

            if ($user) {
                $model->created_by = $user->id;
            }
        });

        static::updating(function ($model) {
            $user = Auth::user();

            if ($user) {
                $model->updated_by = $user->id;
            }
        });

        static::deleting(function ($model) {
            $user = Auth::user();

            if ($user) {
                $model->deleted_by = $user->id;
                $model->save(); // Save the model to store the deleted_by value
            }
        });
    }
}
