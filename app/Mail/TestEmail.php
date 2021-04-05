<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
	use Queueable, SerializesModels;

	public $name;
	public $lastname;
	public $phone;
	public $email;
	public $subject;
	public $message;

	public function __construct($name, $lastname, $phone, $email, $subject, $message)
	{
		$this->name = $name;
		$this->lastname = $lastname;
		$this->phone = $phone;
		$this->email = $email;
		$this->subject = $subject;
		$this->message = $message;
	}

	public function build()
	{
		$address = 'stomamd@stoma.md';
		$name = 'stoma.md';

		return $this->from($address, $name)
			->cc($address, $name)
			->bcc($address, $name)
			->replyTo($address, $name)
			->subject($this->subject)
			->with([ 'name' => $this->name,
				'lastname' => $this->lastname,
				'phone' => $this->phone,
				'email' => $this->email,
				'subject' => $this->subject,
				'message_text' => $this->message])
			->markdown('mail.mail');
	}
}