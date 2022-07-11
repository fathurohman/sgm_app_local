<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function Transaksi(User $user)
    {
        return $this->getPermission($user, 1);
    }

    public function CRUD_Vendor_Client(User $user)
    {
        return $this->getPermission($user, 2);
    }

    public function Cetak_INV(User $user)
    {
        return $this->getPermission($user, 3);
    }

    public function Hak_Akses(User $user)
    {
        return $this->getPermission($user, 4);
    }

    protected function getPermission($user, $p_id)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->id == $p_id) {
                    return true;
                }
            }
        }
        return false;
    }
}
