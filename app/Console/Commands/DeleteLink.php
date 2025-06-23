<?php

namespace App\Console\Commands;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-link';

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
        $link = Link::where("expires_at"); 
       
      if (Carbon::now()->gt($link->expires_at)) {
        
        //$link->delete();
   
}
    }
}
