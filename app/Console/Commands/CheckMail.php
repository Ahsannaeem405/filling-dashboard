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
                $paths = array();
                    if (strpos($message->getSubject()->toString(), 'Nutzer-Anfrage') !== false) {
                        $conversation = Conversation::firstOrCreate([
                            'from' => $message->getFrom()->toArray()[0]->mail,
                            'to' => $message->getTo()->toArray()[0]->mail,
                            'account_id' => $account->id
                        ]);
                        $pattern = '/<b>Nachricht von:<\/b>(.*?)\r/';
                        if (preg_match($pattern, $message->getHTMLBody(), $matches)) {
                            $extractedText = $matches[1];
                            $conversation->name = $extractedText;
                            $conversation->update();
                        }
                        if ($message->hasAttachments()) {
                            foreach ($message->getAttachments() as $attachment) {
                                $publicPath = public_path('content_media');
                                $savePath = $publicPath . '/' . $attachment->getName();
                                file_put_contents($savePath, $attachment->getContent());
                                $paths[] = 'content_media/'.$attachment->getName();
                            }
                        }
                        Messages::create([
                            'conversation_id' => $conversation->id,
                            'from' => $message->getFrom()->toArray()[0]->mail,
                            'to' => $message->getTo()->toArray()[0]->mail,
                            'message' => $message->getTextBody(),
                            'subject' => $message->getSubject()->toString(),
                            'account_id' => $account->id,
                            'image' => $paths
                        ]);
                        // $message->setFlag('seen');
                    }
                }
                $client->disconnect();
            } catch (\Throwable $exception) {
                $account->update(['adStatus' => null]);
            }
        }
    }
}
