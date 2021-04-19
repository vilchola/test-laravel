<?php

namespace App\Console\Commands;

use App\Mail\DemoEmail;
use App\Models\Email;
use App\Http\Controllers\MailController;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Iniciando envio de correos');
        $records = Email::with('user')->where('sended', 0)->get();
        $this->info('Cantidad de correos a enviar: ' . $records->count());
        foreach($records as $record)
        {
            $data = [
                "receiver" => $record->receiver,
                "content" => $record->message,
                "sender" => $record->user->email,
            ];
            \Mail::send("emails.demo", $data, function($message) use ($record) {
                $message->from($record->user->email, $record->user->name);
                $message->to($record->receiver)->subject($record->subject);
            });
            $this->info('Correo enviado a ' . $record->receiver);
            $record->sended = 1;
            $record->save();
        }
        $this->info('Finalizo el envio de correos');
    }
}
