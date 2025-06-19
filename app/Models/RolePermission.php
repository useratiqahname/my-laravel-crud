<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = ['role_id', 'description'];

    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }
}
