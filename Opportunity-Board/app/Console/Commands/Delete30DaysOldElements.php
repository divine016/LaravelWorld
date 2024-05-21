<?php

namespace App\Console\Commands;

use App\Models\Opportunity;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Delete30DaysOldElements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete30-days-old-elements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'use to delete elements that are 30days old';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $maxExistingDays = Carbon::now()->subSeconds(30);
        Opportunity::where('created_at', $maxExistingDays)->delete();
    }
}
