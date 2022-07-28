<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function Job_Order(User $user)
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

    public function History(User $user)
    {
        return $this->getPermission($user, 5);
    }

    public function Report(User $user)
    {
        return $this->getPermission($user, 6);
    }
    public function Sales_Order_Data(User $user)
    {
        return $this->getPermission($user, 7);
    }
    public function History_Sales_Data(User $user)
    {
        return $this->getPermission($user, 8);
    }
    public function Pickup_Job(User $user)
    {
        return $this->getPermission($user, 9);
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
