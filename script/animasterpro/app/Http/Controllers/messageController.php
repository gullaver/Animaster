<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Message;
use App\Category;
use App\Page;
use App\Series;
use App\Blockedip;
use Session;
use App\Mail\replyMail;

class messageController extends Controller
{
    public function sendmessage(Request $request)
    {

        //Check sender IP blocked or no

        //1-Get the watcher IP
        if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
            // Check IP from internet.
            $ip = $_SERVER['HTTP_CLIENT_IP'];

        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
            // Check IP is passed from proxy.
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            
        } else {
            // Get IP address from remote address.
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        //2- check if this IP is blocked
        $findipinblockedips = Blockedip::where('ip_address', $ip)->first();

        if($findipinblockedips)
        {

            session()->flash('err_message', 'You have been blocked from sending messages');
            return back();

            $blockedmember = 1;

        }
        else
        {

        $blockedmember = 0;
        
        $validations =
        [
            "sendername" =>"required|min:3|regex:/^[\pL\s\-]+$/u",
            "senderemail" =>"required|email",
            "sendermsg" =>"required|min:15"
        ];

        $validationMSG =
        [
            "sendername.required" => "Name is required",
            "sendername.min" => "Name must not be less than 3 characters",
            "sendername.regex" => "Name must be in letters only",
            "senderemail.required" => "Email is required",
            "senderemail.email" => "This email is not valid",
            "sendermsg.required" => "Message is required",
            "sendermsg.min" => "Message must not be less than 15 characters"
        ];

        $this->validate($request, $validations, $validationMSG);

        Message::create([
            "name" => $request->sendername,
            "email" => $request->senderemail,
            "message"=> $request->sendermsg,
            "status" => "unread"
        ]);

        session()->flash('success_message', 'Your message has been sent successfully');
        return back();
        }
    }

    public function showcontact()
    {
        $cates = Category::all();
        $pages = Page::all();
        $series = Series::all();

        return view('/contact')->with(compact('cates', 'pages', 'series'));
    }

    public function showMessages()
    {
        Session::put('page', 'message');
        $msgs = Message::paginate(10);
        if(count($msgs) == 0)
        {
            $emptymsg = 0;
            return view('cp.messages.cp_messages')->with(compact('msgs' ,'emptymsg'));
        }
        else
        {
             return view('cp.messages.cp_messages')->with(compact('msgs'));
        }

    }

    public function showNewMessages()
    {
        Session::put('page', 'message');

        $msgs = Message::where('status', 'unread')->paginate(10);
        $newmsgnotice = '';
        if(count($msgs) == 0)
        {
            $emptymsg = 0;
            return view('cp.messages.cp_messages')->with(compact('msgs' ,'emptymsg', 'newmsgnotice'));
        }
        else
        {
             return view('cp.messages.cp_messages')->with(compact('msgs', 'newmsgnotice'));
        }

    }

    public function showMessage($id)
    {

        Session::put('page', 'message');

        $specmsg = Message::where('id', $id)->first();

        $specmsg->update([

            "status" => "read",
        ]);

        return view('cp.messages.cp_read')->with(compact('specmsg'));

    }

    public function destroy($id)
    {

        Message::where('id', $id)->delete();
        session()->flash('success_message', 'Message has been deleted successfully');
        return back();

    }

    public function forwardmessage(request $request, $senderemail)
    {
        $validation = [
            "adminreply" => "required",
        ];

        $validationmsg = [
            "adminreply" => "Message field can not be empty",
        ];

        $this->validate($request, $validation, $validationmsg);

        if(!filter_var($senderemail, FILTER_VALIDATE_EMAIL))
        {
            session()->flash('err_message', 'Invalid email address');
            return back();
        }
        else
        {
            $email = filter_var($senderemail, FILTER_SANITIZE_EMAIL);
            $data = $request->all();

            Mail::to($email)->send(new replyMail($data));

            session()->flash('success_message', 'Your message has been sent successfully');
            return back();
        }
        
    }
}
