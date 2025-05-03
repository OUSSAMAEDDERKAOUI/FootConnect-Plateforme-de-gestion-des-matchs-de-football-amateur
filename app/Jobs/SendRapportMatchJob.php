<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RapportMatchMail;
use Illuminate\Support\Facades\Mail;

class SendRapportMatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $email;

    public function __construct(array $data, string $email)
    {
        $this->data = $data;
        $this->email = $email;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new RapportMatchMail($this->data));
    }
}
