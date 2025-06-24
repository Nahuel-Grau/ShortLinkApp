<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;



use function Illuminate\Log\log;

class DeleteLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:deleteLink';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
   Link::where('expires_at', '<', now())->delete();

    }
}
