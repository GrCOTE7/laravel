<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/** Send an email for testing.
 * @property string $data
 */
class TestMail extends Mailable
{
	use Queueable;
	use SerializesModels;

	public $data;

	/**
	 * Create a new message instance.
	 */
	public function __construct(?string $data = null)
	{
		$this->data = $data;
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			from: new Address(env('MAIL_FROM_ADDRESS', 'admin@contact.com'), 'John Lennon'),
			subject: 'Test Mail',
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		$data = [
			'key777' => 'value777',
			'data'   => $this->data ?? 'Data venant possiblement d\'un formulaire',
		];

		return new Content(
			view: 'emails.testmail',
			with: $data
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, \Illuminate\Mail\Mailables\Attachment>
	 */
	public function attachments(): array
	{
		return [];
	}
}
