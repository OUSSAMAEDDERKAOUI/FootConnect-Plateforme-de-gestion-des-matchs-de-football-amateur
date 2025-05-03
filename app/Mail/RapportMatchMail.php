<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class RapportMatchMail extends Mailable
{
    use Queueable, SerializesModels;

    public $game, $rapport, $date, $equipe_domicile, $equipe_exterieur, $buteurs, $sanctions, $changements, $arbitreCentral, $assistant1, $assistant2, $delegue;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.rapport_match', [
            'game' => $this->game,
            'equipe_domicile' => $this->equipe_domicile,
            'equipe_exterieur' => $this->equipe_exterieur,
            'rapport' => $this->rapport,
            'date' => $this->date,
            'buteurs' => $this->buteurs,
            'sanctions' => $this->sanctions,
            'changements' => $this->changements,
            'arbitreCentral' => $this->arbitreCentral,
            'assistant1' => $this->assistant1,
            'assistant2' => $this->assistant2,
            'delegue' => $this->delegue,
        ]);

        $filename = 'rapport_' . $this->game->id . '.pdf';

        return $this->subject('Rapport de match')
                    ->view('emails.rapport_envoye')
                    ->attachData($pdf->output(), $filename, [
                        'mime' => 'application/pdf',
                    ]);
    }
}
