<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	 protected $user;
	 protected $subject;
	 
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$subject)
    {
        //
		$this->user = $user;
		$this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        //
		
		//填寫收信人信箱
		$to = ['email'=>$this->user->user_email,
			   'name'=>$this->user->user_name
			   ];
		//信件的內容(即表單填寫的資料)
		$data = ['content'=>$this->user->user_name.' '.date("Y/m/d H:i:s")." 登入成功"				 
			 ];
		//寄出信件
		$mailer->send('emails.post', $data, function($message) use ($to) {
			$message->to($to['email'], $to['name'])->subject($this->subject);
		});
    }
}
