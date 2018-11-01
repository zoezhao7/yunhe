<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/10/19
 * Time: 12:13
 */

namespace App\Policies;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeRolePolicy extends Policy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return \Auth::guard('store')->user()->isSuperAdmin();
    }

    public function update()
    {
        return true;
    }

    public function destroy()
    {
        return true;
    }

}