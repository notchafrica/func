<?php

namespace NotchAfrica\Func\Currency\Contracts;

use DateTime;

interface DriverInterface
{
    /**
     * Create a new currency.
     *
     * @return bool
     */
    public function create(array $params);

    /**
     * Get all currencies.
     *
     * @return array
     */
    public function all();

    /**
     * Get given currency from storage.
     *
     * @param  string  $code
     * @param  int  $active
     * @return mixed
     */
    public function find($code, $active = 1);

    /**
     * Update given currency.
     *
     * @param  string  $code
     * @return int
     */
    public function update($code, array $attributes, ?DateTime $timestamp = null);

    /**
     * Remove given currency from storage.
     *
     * @return int
     */
    public function delete($code);
}
