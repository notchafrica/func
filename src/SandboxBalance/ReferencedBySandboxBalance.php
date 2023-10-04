<?php

namespace NotchAfrica\Func\SandboxBalance;

trait ReferencedBySandboxBalance
{
    public function balanceReferences()
    {
        return $this->morphMany(AvailableBalance::class, 'ref');
    }
}
