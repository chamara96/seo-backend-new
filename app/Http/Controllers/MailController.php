<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\Setting;


class MailController extends Controller
{
    public function findEnvSetting($name)
    {
        $env_settings = Setting::all()->toArray();
        foreach ($env_settings as $key => $value) {
            if ($value['name'] == $name) {
                return $value['val'];
            }
            // return $value['name'];
        }
    }

    public function basic_email()
    {
        $data = array('mail_body' => $this->findEnvSetting('email_temp'),);


        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('cmbuni2@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
            $message->from('from@seoexample.com', 'Virat Gandhi123');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
}
