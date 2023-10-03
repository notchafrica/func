<?php

namespace Notch\Func\AvailableBalance;

use Notch\Func\SandboxBalance\AvailableBalance;

trait ReferencedByAvailableBalance
{
    public function balanceReferences()
    {
        return $this->morphMany(AvailableBalance::class, 'ref');
    }
}
