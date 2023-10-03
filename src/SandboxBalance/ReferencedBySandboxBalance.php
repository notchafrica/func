<?php

namespace Notch\Func\SandboxBalance;

trait ReferencedBySandboxBalance
{
    public function balanceReferences()
    {
        return $this->morphMany(AvailableBalance::class, 'ref');
    }
}
