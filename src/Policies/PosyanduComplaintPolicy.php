<?php

namespace Module\Posyandu\Policies;

use Illuminate\Auth\Access\Response;
use Module\System\Models\SystemUser;
use Module\Posyandu\Models\PosyanduComplaint;

class PosyanduComplaintPolicy
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
        return $user->hasPermission('view-posyandu-complaint');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, PosyanduComplaint $posyanduComplaint): bool
    {
        return $user->hasPermission('show-posyandu-complaint');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-posyandu-complaint');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, PosyanduComplaint $posyanduComplaint): bool
    {
        return $user->hasPermission('update-posyandu-complaint');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, PosyanduComplaint $posyanduComplaint): bool
    {
        return $user->hasPermission('delete-posyandu-complaint');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, PosyanduComplaint $posyanduComplaint): bool
    {
        return $user->hasPermission('restore-posyandu-complaint');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, PosyanduComplaint $posyanduComplaint): bool
    {
        return $user->hasPermission('destroy-posyandu-complaint');
    }
}
