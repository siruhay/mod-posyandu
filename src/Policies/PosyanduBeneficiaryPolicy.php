<?php

namespace Module\Posyandu\Policies;

use Module\System\Models\SystemUser;
use Module\Posyandu\Models\PosyanduBeneficiary;
use Illuminate\Auth\Access\Response;

class PosyanduBeneficiaryPolicy
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
        return $user->hasPermission('view-posyandu-beneficiary');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, PosyanduBeneficiary $posyanduBeneficiary): bool
    {
        return $user->hasPermission('show-posyandu-beneficiary');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-posyandu-beneficiary');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, PosyanduBeneficiary $posyanduBeneficiary): bool
    {
        return $user->hasPermission('update-posyandu-beneficiary');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, PosyanduBeneficiary $posyanduBeneficiary): bool
    {
        return $user->hasPermission('delete-posyandu-beneficiary');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, PosyanduBeneficiary $posyanduBeneficiary): bool
    {
        return $user->hasPermission('restore-posyandu-beneficiary');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, PosyanduBeneficiary $posyanduBeneficiary): bool
    {
        return $user->hasPermission('destroy-posyandu-beneficiary');
    }
}
