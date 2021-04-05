<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Sichikawa\LaravelSendgridDriver\SendGrid;


class MailController extends Controller
{
	use SendGrid;

	public function sendMail(Request $request)
	{

		$name = $request->name;
		$lastname = $request->lastname;
		$phone = $request->phone;
		$email = $request->email;
		$subject = $request->subject;
		$message = $request->message;

		Mail::to( 'stomaassociation2011@gmail.com' )->send( new TestEmail( $name, $lastname, $phone, $email, $subject, $message ) );

	}
}

