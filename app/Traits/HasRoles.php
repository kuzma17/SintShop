<?php

namespace App\Traits;

use App\Models\Role;

trait HasRoles
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role) {
        if ($this->role && $this->role->slug === $role) {
            return true;
        }
        return false;
    }

}
