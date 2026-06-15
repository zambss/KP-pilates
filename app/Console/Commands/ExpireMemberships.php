<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Membership;
use Carbon\Carbon;

class ExpireMemberships extends Command
{
    protected $signature = 'membership:expire';
    protected $description = 'Update membership yang sudah habis menjadi expired';

    public function handle()
    {
        $count = Membership::whereDate('end_date', '<', Carbon::today())
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        $this->info("{$count} membership expired.");
    }
}
