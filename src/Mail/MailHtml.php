<?php

namespace Darvis\Manta\Mail;


use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class MailHtml extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $pdfData;

    /**
     * Maak een nieuwe mail instance.
     */
    public function __construct($subject, $content, $pdfData = [])
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->pdfData = $pdfData;
    }

    public function build()
    {
        $email = $this->subject($this->subject)
            ->view('manta::mail.html', [
                'subject' => $this->subject,
                'content' => $this->content
            ]);



        // Als er een PDF-data is, stream deze als attachment
        if (is_array($this->pdfData)) {
            foreach ($this->pdfData as $pdf) {
                $email->attachData($pdf['stream'], $pdf['filename'], [
                    'mime' => $pdf['mime'],
                ]);
            }
        }


        return $email;
    }
}
