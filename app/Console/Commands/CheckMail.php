<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Conversation;
use App\Models\Messages;
use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;


class CheckMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
  $accounts = Account::where('adStatus', 'ACTIVE')->get();
        foreach ($accounts as $account) {
            RefreshAccount($account);
        }
    }
}
