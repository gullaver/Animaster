<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;
use Hash;
use Image;
use Session;
use Carbon\Carbon;
use App\Message;
use App\User;
use App\Comment;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //GET CP INDEX PAGE WITH MULTI DATA

        //GET UNREAD MESSAGES
        $latestmsgs = Message::where('status', 'unread')->get();
        $countmsgs = $latestmsgs->count();

        //GET LATEST COMMENTS DURING LAST 24 HOURS
        $latestcomments = Comment::where('created_at', '>=', Carbon::today()->subDays(1))->get();
        $countcomments = $latestcomments->count();

        //GET LATEST REGISTRANTS DURING THE LAST 24 HOURS
        $latestusers = User::where('created_at', '>=', Carbon::today()->subDays(1))->get();
        $countusers = $latestusers->count();

        Session::put('page','dashboard');
        return view('cp.index')->with(compact('latestmsgs', 'countmsgs', 'latestcomments', 'countcomments', 'latestusers', 'countusers'));
    }

    // SETTINGS
    // GET ADMIN SETTINGS
    public function getAdminSettings()
    {
        session::put('page','settings');

        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $adminimage = Admin::where('email', Auth::guard('admin')->user()->email)->first()->image;
        return view('cp.cp_admin_settings')->with(compact('adminDetails', 'adminimage'));
    }

    // CHECK ADMIN PASSWORD - INFO UPDATE
    public function chk_pwd(Request $request)
    {
        session::put('page','settings');

        $data = $request->all();
        $pass = Auth::guard('admin')->user()->password;


       if(Hash::check($data['current_pwd'], $pass))
       {
           echo 'true';
       }
       else{
           echo 'false';
       }
       
    }
        // CHECK ADMIN PASSWORD - PASSWORD UPDATE
        public function chk_pwd_ch(Request $request)
        {
            session::put('page','settings');

            $data = $request->all();
            $pass = Auth::guard('admin')->user()->password;
    
    
           if(Hash::check($data['current_pwd'], $pass))
           {
               echo 'true';
           }
           else{
               echo 'false';
           }
           
        }
    // UPDATE ADMIN'S INFO
    public function upinfo(Request $request)
    {
        session::put('page','settings');

        $data = $request->all();
        $pass = Auth::guard('admin')->user()->password;

        //CHECK IF PASSWORD ENTERED IS CORRECT
        if(Hash::check($data['current_em_password'], $pass))
        {

            $validations=[
                "name"=>"alpha|min:3",
                 "email"=>"email",
                 "pimage"=>"mimes:jpeg,jpg,png|required|max:999999999999",
            ];
            $validationMsgs =[
                "name.alpha"=>"The name must be in letters only without spaces", 
                "name.min"=>"The name must be 3 characters at least",
                "email.email"=>"The email must be valid",
                "pimage.mimes"=>"Valid image is required",
                "pimage.max"=>"Image maximum size is 5MB"
            ];

            $this->validate($request,$validations,$validationMsgs);

            if($request->hasFile('pimage'))
            {
                $image_temp = $request->file('pimage');
                if($image_temp->isValid())
                {

                    $exten = $image_temp->getClientOriginalExtension();
                    $imageName = rand(111111111111111, 999999999999999).'.'.$exten;
                    $imagePath = 'public/images/admin_images/admin_photoes/'.$imageName;
                    Image::make($image_temp)->save($imagePath);

                }
                elseif(!empty($data['current_image']))
                {
                    $imageName = $data['current_image'];
                }
                else
                {
                    $imageName = '';
                }
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update([

                'name' => $data['name'],
                'image' => $imageName,
                'email' => $data['email'],
                'password' => bcrypt($data['current_em_password']),

            ]);

            session()->flash('success_message', 'Data has been updated successfully');
            return redirect()->back();
        }
        else
        {
            session()->flash('err_message', 'Current password is incorrect');
            return redirect()->back();
        }
    }

    // Update Admin's Paswword
    public function uppwd(Request $request)
    {
        session::put('page','settings');

        $data = $request->all();
        $pass = Auth::guard('admin')->user()->password;

        if(Hash::check($data['oldpassword'], $pass))
        {
            if($data['newpassword']==$data['newpasswordconf'])
            {

                $validations=[
                    "newpassword"=>"required|min:6",
                ];
                
                $validationMsgs =
                [
                    "newpassword.required" => "Please enter new password", 
                    "newpassword.min" => "Password must not be less than 6 characters",
                ];


                $this->validate($request,$validations,$validationMsgs);
                
                Admin::where('id', Auth::guard('admin')->user()->id)->update([

                'password' => bcrypt($data['newpassword']),
                ]);

                

                session()->flash('success_message', 'Password has been updated successfully');
                return redirect()->back();
                

            }
            else
            {
                session()->flash('err_message', 'New password does not match password confirmation');
                return redirect()->back(); 
            }

        }
        else
        {
            session()->flash('err_message', 'Current password is incorrect');
            return redirect()->back();
        }
    }

    //Remove admin Image
    public function removeAdminImage()
    {
        session::put('page','settings');

        Admin::where('id', Auth::guard('admin')->user()->id)->update(['image'=>'default.png']);

        session()->flash('success_message', 'Image has been removed successfully');
        echo 'true';
    }

}
