<?php

namespace NotchAfrica\Func\AvailableBalance;

use Illuminate\Support\Arr;

trait HasAvailableBalance
{
    /**
     * Get the model's balance amount.
     *
     * @return float|int
     */
    public function getAvailableBalanceAttribute()
    {
        return $this->availableBalanceHistory()->sum('amount') / 100;
    }

    /**
     * Get the model's balance amount.
     *
     * @return int
     */
    public function getIntAvailableBalanceAttribute()
    {
        return (int) $this->availableBalanceHistory()->sum('amount');
    }

    /**
     * Increase the balance amount.
     *
     * @return \MrEduar\Balance\Balance
     */
    public function increaseAvailableBalance(float $amount, array $parameters = [])
    {
        return $this->createAvailableBalanceHistory(round($amount), $parameters);
    }

    /**
     * Decrease the balance amount
     *
     * @return \MrEduar\Balance\Balance
     */
    public function decreaseAvailableBalance(float $amount, array $parameters = [])
    {
        return $this->createAvailableBalanceHistory(-1 * abs(round($amount)), $parameters);
    }

    /**
     * Modify the balance sheet with the given value.
     *
     * @return \MrEduar\Balance\Balance
     */
    public function modifyAvailableBalance(float $amount, array $parameters = [])
    {
        return $this->createAvailableBalanceHistory(round($amount), $parameters);
    }

    /**
     * Reset the balance to 0 or set a new value.
     *
     * @param  array  $parameters
     * @return \MrEduar\Balance\Balance
     */
    public function resetAvailableBalance(float $newAmount = null, $parameters = [])
    {
        $this->availableBalanceHistory()->delete();

        if (is_null($newAmount)) {
            return true;
        }

        return $this->createAvailableBalanceHistory(round($newAmount), $parameters);
    }

    /**
     * Check if there is a positive balance.
     *
     * @return bool
     */
    public function hasAvailableBalance($amount = 1)
    {
        return $this->balance > 0 && $this->availableBalanceHistory()->sum('amount') >= $amount;
    }

    /**
     * Check if there is no more balance.
     *
     * @return bool
     */
    public function hasNoAvailableBalance()
    {
        return $this->balance <= 0;
    }

    /**
     * Function to handle mutations (increase, decrease).
     *
     * @return \MrEduar\Balance\Balance
     */
    protected function createAvailableBalanceHistory(float $amount, array $parameters = [])
    {
        $reference = Arr::get($parameters, 'reference');

        $createArguments = collect([
            'amount' => round($amount),
            'description' => Arr::get($parameters, 'description'),
        ])->when($reference, function ($collection) use ($reference) {
            return $collection
                ->put('ref_type', $reference->getMorphClass())
                ->put('ref_id', $reference->getKey());
        })->toArray();

        return $this->availableBalanceHistory()->create($createArguments);
    }

    /**
     * Get all Balance History.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function availableBalanceHistory()
    {
        return $this->morphMany(AvailableBalance::class, 'balanceable');
    }
}
