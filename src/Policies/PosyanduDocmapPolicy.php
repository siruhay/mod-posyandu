<?php

namespace Module\Posyandu\Policies;

use Module\System\Models\SystemUser;
use Module\Posyandu\Models\PosyanduDocmap;
use Illuminate\Auth\Access\Response;

class PosyanduDocmapPolicy
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
        return $user->hasPermission('view-posyandu-docmap');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, PosyanduDocmap $posyanduDocmap): bool
    {
        return $user->hasPermission('show-posyandu-docmap');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-posyandu-docmap');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, PosyanduDocmap $posyanduDocmap): bool
    {
        return $user->hasPermission('update-posyandu-docmap');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, PosyanduDocmap $posyanduDocmap): bool
    {
        return $user->hasPermission('delete-posyandu-docmap');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, PosyanduDocmap $posyanduDocmap): bool
    {
        return $user->hasPermission('restore-posyandu-docmap');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, PosyanduDocmap $posyanduDocmap): bool
    {
        return $user->hasPermission('destroy-posyandu-docmap');
    }
}
