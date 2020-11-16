<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Mail;

class MailContactUsController extends Controller
{
    //
    public function sendmail_contactus(Request $request)
    {

        $admin_email_setting = \App\Providers\AppServiceProvider::findEnvSetting("email");
        $contactus_email_setting = \App\Providers\AppServiceProvider::findEnvSetting("email_contact_us");
        // dd($admin_email_setting);



        // $validatedData = $request->validate([
        //     'name' => 'required'|'max:255',
        //     'email' => 'required',
        //     'subject' => 'required',
        //     'msgBody' => 'required',
        // ]);

        // dd($request);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'msgBody' => $request->msgbody
        ];

        // return $data;

        // $admin_mail=\App\Providers\AppServiceProvider::findEnvSetting("email_contact_us");

        // return $admin_mail;

        if ($data['name'] == null || $data['email'] == null || $data['subject'] == null || $data['msgBody'] == null || $admin_mail == null) {
            return "Error, Fill all";
        }


        Mail::send('mailcontactus', $data, function ($mail) use ($contactus_email_setting, $admin_email_setting, $request) {
            $mail->from($admin_email_setting);
            $mail->to($contactus_email_setting);
            $mail->subject($request->subject);
        });

        return 'Successfully send';
    }
}
