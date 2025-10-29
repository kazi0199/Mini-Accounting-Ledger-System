<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Content, Envelope};
use Illuminate\Queue\SerializesModels;

class LedgerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $account;
    public $transactions;

    /**
     * Create a new message instance.
     */
    public function __construct($account, $transactions)
    {
        $this->account = $account;
        $this->transactions = $transactions;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ledger Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Ledger Report - '.$this->account->name)
                    ->view('emails.report');
    }
}
