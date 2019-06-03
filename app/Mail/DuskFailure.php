<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;

class DuskFailure extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = $this->view('email.dusk_failure');
        $files = File::allFiles('tests/Browser/screenshots');
        return $this->view('email.dusk_failure', [
            'files' => $files,
        ])->attach(storage_path('logs/laravel.log'));
    }
}
