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
            try {
                $data = explode(':', $account->description);
                $client = Client::make([
                    'host' => 'imap.web.de',
                    'port' => 993,
                    'encryption' => 'ssl',
                    'validate_cert' => true,
                    'username' => $data[0],
                    'password' => $data[1],
                    'protocol' => 'imap'
                ]);
                $client->connect();
                $inbox = $client->getFolder('INBOX'); //INBOX,Spam
                $newMessages = $inbox->query()->unseen()->all()->get();
                foreach ($newMessages as $message) {
                    $conversation = Conversation::firstOrCreate(['from' => $message->getFrom()->toArray()[0]->mail, 'to' => $message->getTo()->toArray()[0]->mail, 'account_id' => $account->id]);
                    Messages::create([
                        'conversation_id' => $conversation->id,
                        'from' => $message->getFrom()->toArray()[0]->mail,
                        'to' => $message->getTo()->toArray()[0]->mail,
                        'message' => $message->getTextBody(),
                        'subject' => $message->getSubject()->toString(),
                        'account_id' => $account->id
                    ]);
                    // $message->setFlag('seen');
                }
                $client->disconnect();
            } catch (\Throwable $exception) {
                $account->update(['adStatus' => null]);
            }
        }
    }
}
