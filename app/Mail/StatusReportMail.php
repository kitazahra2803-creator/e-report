<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $oldStatus;
    public $newStatus;

    public function __construct(Report $report, $oldStatus, $newStatus)
    {
        $this->report = $report;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Status Laporan Anda Telah Berubah - E-Report',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.status_report',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
