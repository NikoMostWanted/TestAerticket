<?php
declare(strict_types=1);

namespace App\Constant;

use App\Entity\User\User;

class Role extends BaseConstant
{
    public const ROLE_USER = User::ROLE_DEFAULT;
    public const ROLE_ADMIN = 'ROLE_ADMIN';
}