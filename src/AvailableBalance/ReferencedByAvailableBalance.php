<?php

namespace NotchAfrica\Func\AvailableBalance;

use NotchAfrica\Func\SandboxBalance\AvailableBalance;

trait ReferencedByAvailableBalance
{
    public function balanceReferences()
    {
        return $this->morphMany(AvailableBalance::class, 'ref');
    }
}
