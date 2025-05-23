<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostPublishedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $url;

    public function __construct($post)
    {
        $this->post = $post;
        $this->url = route('posts.show', $post);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новый пост: ' . $this->post->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.post-published',
        );
    }
}