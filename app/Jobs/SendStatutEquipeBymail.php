<?php

namespace App\Jobs;

use App\Models\Equipe;
use App\Models\AdminEquipe;
use Illuminate\Bus\Queueable;
use App\Mail\TeamStatusUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendStatutEquipeBymail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $equipe;
    /**
     * Create a new job instance.
     */
    public function __construct(Equipe $equipe)
    {
        $this->equipe=$equipe;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $admin = AdminEquipe::where('equipe_id', $this->equipe->id)->first();

        Mail::to($admin->email)->send(new TeamStatusUpdated($this->equipe));

    }
}
