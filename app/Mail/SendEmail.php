<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
  
class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $noSj, $idPo, $sjItems;

    public function __construct($noSj, $idPo, $sjItems)
    {
        $this->sjItems = $sjItems;
        $this->noSj = $noSj;
        $this->idPo = $idPo;
    }
  
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daftar Item Surat Jalan',
        );
    }
  
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email',
        );
    }
  
    /**
     * Get the attachments for the message.
     *
     * @return array

     */
    public function attachments(): array
    {
        return [];
    }
}