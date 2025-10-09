<?php

namespace Module\Posyandu\Policies;

use Module\System\Models\SystemUser;
use Module\Posyandu\Models\PosyanduFunding;
use Illuminate\Auth\Access\Response;

class PosyanduFundingPolicy
{
    /**
    * Perform pre-authorization checks.
    */
    public function before(SystemUser $user, string $ability): bool|null
    {
        if ($user->hasLicenseAs('posyandu-superadmin')) {
            return true;
        }
    
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function view(SystemUser $user): bool
    {
        return $user->hasPermission('view-posyandu-funding');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, PosyanduFunding $posyanduFunding): bool
    {
        return $user->hasPermission('show-posyandu-funding');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-posyandu-funding');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, PosyanduFunding $posyanduFunding): bool
    {
        return $user->hasPermission('update-posyandu-funding');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, PosyanduFunding $posyanduFunding): bool
    {
        return $user->hasPermission('delete-posyandu-funding');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, PosyanduFunding $posyanduFunding): bool
    {
        return $user->hasPermission('restore-posyandu-funding');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, PosyanduFunding $posyanduFunding): bool
    {
        return $user->hasPermission('destroy-posyandu-funding');
    }
}
