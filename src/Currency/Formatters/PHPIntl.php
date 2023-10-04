<?php

namespace NotchAfrica\Func\Currency\Formatters;

use NotchAfrica\Func\Currency\Contracts\FormatterInterface;
use NumberFormatter;

class PHPIntl implements FormatterInterface
{
    /**
     * Number formatter instance.
     *
     * @var NumberFormatter
     */
    protected $formatter;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
    }

    /**
     * {@inheritdoc}
     */
    public function format($value, $code = null)
    {
        return $this->formatter->formatCurrency($value, $code);
    }
}
