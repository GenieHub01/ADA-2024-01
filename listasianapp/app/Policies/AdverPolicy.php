<?php

namespace App\Policies;

use App\Models\Advert;
use App\Models\User;

class AdvertPolicy
{
    public function update(User $user, Advert $advert)
    {
        return $user->id === $advert->user_id || $user->isAdmin();
    }
}
