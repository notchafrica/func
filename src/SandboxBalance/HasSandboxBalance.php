<?php

namespace NotchAfrica\Func\SandboxBalance;

use Illuminate\Support\Arr;
use NotchAfrica\Func\AvailableBalance\AvailableBalance;

trait HasSandboxBalance
{
    /**
     * Get the model's balance amount.
     *
     * @return float|int
     */
    public function getSandboxBalanceAttribute()
    {
        return $this->sandboxBalanceHistory()->sum('amount') / 100;
    }

    /**
     * Get the model's balance amount.
     *
     * @return int
     */
    public function getIntSandboxBalanceAttribute()
    {
        return (int) $this->sandboxBalanceHistory()->sum('amount');
    }

    /**
     * Increase the balance amount.
     *
     * @return \MrEduar\Balance\Balance
     */
    public function increaseSandboxBalance(int $amount, array $parameters = [])
    {
        return $this->createSandboxBalanceHistory($amount, $parameters);
    }

    /**
     * Decrease the balance amount
     *
     * @return \MrEduar\Balance\Balance
     */
    public function decreaseSandboxBalance(int $amount, array $parameters = [])
    {
        return $this->createSandboxBalanceHistory(-1 * abs($amount), $parameters);
    }

    /**
     * Modify the balance sheet with the given value.
     *
     * @return \MrEduar\Balance\Balance
     */
    public function modifySandboxBalance(int $amount, array $parameters = [])
    {
        return $this->createSandboxBalanceHistory($amount, $parameters);
    }

    /**
     * Reset the balance to 0 or set a new value.
     *
     * @param  array  $parameters
     * @return \MrEduar\Balance\Balance
     */
    public function resetSandboxBalance(int $newAmount = null, $parameters = [])
    {
        $this->sandboxBalanceHistory()->delete();

        if (is_null($newAmount)) {
            return true;
        }

        return $this->createSandboxBalanceHistory($newAmount, $parameters);
    }

    /**
     * Check if there is a positive balance.
     *
     * @return bool
     */
    public function hasSandboxBalance(int $amount = 1)
    {
        return $this->balance > 0 && $this->sandboxBalanceHistory()->sum('amount') >= $amount;
    }

    /**
     * Check if there is no more balance.
     *
     * @return bool
     */
    public function hasNoSandboxBalance()
    {
        return $this->balance <= 0;
    }

    /**
     * Function to handle mutations (increase, decrease).
     *
     * @return \MrEduar\Balance\Balance
     */
    protected function createSandboxBalanceHistory(int $amount, array $parameters = [])
    {
        $reference = Arr::get($parameters, 'reference');

        $createArguments = collect([
            'amount' => $amount,
            'description' => Arr::get($parameters, 'description'),
        ])->when($reference, function ($collection) use ($reference) {
            return $collection
                ->put('ref_type', $reference->getMorphClass())
                ->put('ref_id', $reference->getKey());
        })->toArray();

        return $this->sandboxBalanceHistory()->create($createArguments);
    }

    /**
     * Get all Balance History.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function sandboxBalanceHistory()
    {
        return $this->morphMany(AvailableBalance::class, 'balanceable');
    }
}
