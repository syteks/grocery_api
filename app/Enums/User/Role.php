<?php

namespace App\Enums\User;

enum Role: string
{
    case Admin = 'admin';
    case User = 'user';
}
