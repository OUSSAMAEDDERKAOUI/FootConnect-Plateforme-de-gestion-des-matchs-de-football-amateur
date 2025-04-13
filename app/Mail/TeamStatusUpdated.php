<?php

namespace App\Mail;

use App\Models\Equipe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeamStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;
    public $equipe;
    public function __construct(Equipe $equipe)
    {
        $this->equipe = $equipe;
    }


    public function build()
{
    return $this->subject('Statut de l\'équipe mis à jour')
                ->view('emails.TeamStatusUpdated')
                ->with('equipe', $this->equipe);
}
}
