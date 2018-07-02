<?php

	namespace App\Services;
	
	use Laravel\Lumen\Routing\Controller as BaseController;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Mail;

	class Emails {
		public function report($report){
			$env_emails = env('MAIL_EMAILS');
			$get_emails = explode(";", $env_emails);

			foreach($get_emails as $email){
				Mail::raw($report, function($msg) use ($email) {
					$msg->to($email);
					$msg->from(['datamart@wunderman.com']);
				});
			}
		}
	}
