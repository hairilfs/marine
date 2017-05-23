<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;

class SendEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data_email = array();
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($all_data)
    // public function __construct(EmailData $data)
    {
        // dd($all_data);
        $this->data_email['sender_email']   = $all_data['sender_email'];
        $this->data_email['sender_name']    = $all_data['sender_name'];
        $this->data_email['target_email']   = $all_data['target_email'];
        $this->data_email['target_name']    = $all_data['target_name'];
        $this->data_email['body_message']   = $all_data['body_message'];
        $this->data_email['subject']        = $all_data['subject'];
        if(isset($all_data['filename'])) {
            $this->data_email['filename'] = $all_data['filename'];
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        // dd($this->data_email);
        // $mailer->send('email.welcome', ['data'=>'data'], function ($message) {

        //     $message->from('nwambachristian@gmail.com', 'Christian Nwmaba');

        //     $message->to('nwambachristian@gmail.com');

        // });

        $target_email = $this->data_email['target_email'];
        $target_name = $this->data_email['target_name'];
        // Mail::send('email.template', array('body_message' => $body_message, 'subject' => $subject, 'target_name' => $target_name ), function($message) use ($subject, $name, $email, $target_email, $target_name, $_file_name) {
        $mailer->send('email.template', $this->data_email, function($message)  {
            $message->from($this->data_email['sender_email'], $this->data_email['sender_name']);
            $message->to($this->data_email['target_email'], $this->data_email['target_name'])->subject($this->data_email['subject']);
            
            if(isset($this->data_email['filename'])) {
                $message->attach(public_path('files/'.$this->data_email['filename']));
            }
        });
    }
}
