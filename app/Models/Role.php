<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected $ADMIN_ROLE = 1;

    protected $DUTY_ROLE = 2;

    protected $PILOT_ROLE = 3;

    public function users()
    {
        return $this->hasOne(Role::class, 'role_id');
    }

    public function menuAccess()
    {
        return $this->hasOne(MenuAccess::class, 'role_id');
    }

    public function subMenuAccess()
    {
        return $this->hasOne(SubMenuAccess::class, 'role_id');
    }
}
