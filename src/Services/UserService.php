<?php
namespace Lakm\Contact\Services;

use App\Models\User;

class UserService
{
    public function getAdmins()
    {
        if (config('contactUs.users')) {
            $user = config('contactUs.users');
        } elseif (config('contactUs.relationship')) {
            $user = User::select(config('contactUs.name_column'),
                config('contactUs.email_column'))
                ->whereHas(config('contactUs.relationship'), function ($query) {
                    $query->whereIn(config('contactUs.role_column_name'),
                        config('contactUs.roles'));
                    $query->whereIn(config('contactUs.role_column_name'),
                        config('contactUs.roles'));
                })->get();
        } else {
            $user = User::select(config('contactUs.name_column'),
                config('contactUs.email_column'))
                ->whereIn('contactUs.role_column_name', config('contactUs.roles'))
                ->get();
        }

        return $user;
    }
}