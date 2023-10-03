<?php

namespace NotchAfrica\Func\Commands;

use Illuminate\Console\Command;

class FuncCommand extends Command
{
    public $signature = 'func';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
