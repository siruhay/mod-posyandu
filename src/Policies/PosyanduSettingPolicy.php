<?php

namespace Module\Posyandu\Policies;

use Module\System\Models\SystemUser;
use Module\Posyandu\Models\PosyanduSetting;
use Illuminate\Auth\Access\Response;

class PosyanduSettingPolicy
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
        return $user->hasPermission('view-posyandu-setting');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(SystemUser $user, PosyanduSetting $posyanduSetting): bool
    {
        return $user->hasPermission('show-posyandu-setting');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SystemUser $user): bool
    {
        return $user->hasPermission('create-posyandu-setting');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SystemUser $user, PosyanduSetting $posyanduSetting): bool
    {
        return $user->hasPermission('update-posyandu-setting');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SystemUser $user, PosyanduSetting $posyanduSetting): bool
    {
        return $user->hasPermission('delete-posyandu-setting');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SystemUser $user, PosyanduSetting $posyanduSetting): bool
    {
        return $user->hasPermission('restore-posyandu-setting');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(SystemUser $user, PosyanduSetting $posyanduSetting): bool
    {
        return $user->hasPermission('destroy-posyandu-setting');
    }
}
