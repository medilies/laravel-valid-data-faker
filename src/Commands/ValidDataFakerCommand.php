<?php

namespace Elaboratecode\ValidDataFaker\Commands;

use Illuminate\Console\Command;

class ValidDataFakerCommand extends Command
{
    public $signature = 'laravel-valid-data-faker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
