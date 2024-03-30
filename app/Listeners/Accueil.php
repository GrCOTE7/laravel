<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Events\Accueil as AcceuilEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Accueil
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AcceuilEvent $event): void
    {
        DB::table('visits')->insert([
            'ip' => request()->ip(),
            'created_at' => Carbon::now(),
        ]);
    }
}
