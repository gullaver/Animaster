<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paginate;
use Session;
use App\User;
use App\Blockedip;
use Hash;

class managememController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //SHOW MEMBERS INDEX
    public function index()
    {
        Session::put('page', 'members');
        $members = User::orderBy('created_at', 'desc')->paginate(10);

       if(count($members)==0)
       {
           $emptymem = 0;
           return view('cp/members/cp_members')->with(compact('members', 'emptymem'));

       }
       else
       {
            return view('cp/members/cp_members')->with(compact('members'));
       }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //SHOW ADD NEW MEMBER PAGE FROM CP
    public function create()
    {
        Session::put('page','members');

        return view('cp/members/cp_addmember');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //ADD NEW MEMBER AND SAVE DATA FROM CP
    public function store(Request $request)
    {
        $validations = 
        [
            "memname"=>"required",
            "email"=>"required|unique:users",
            "mempass"=>"required"
        ];


        $validationMSG = 
        [
            "memname.required" =>"Member name is required",
            "email.required" =>"Member email is required",
            "email.unique" =>"This member is already registered",
            "mempass.required" =>"Password is required"
        ];


        $this->validate($request, $validations, $validationMSG);


        User::create(
        [
            "name"=> $request->memname,
            "email"=> $request->email,
            "password"=> Hash::make($request->mempass)
        ]);


        session()->flash('success_message', 'Member has been Added successfully');
        return redirect(route('cp_managemem.index'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //SHOW EDIT MEMBER'S EDIT PAGE
    public function edit($id)
    {
        Session::put('page','members');

        $certainMem = User::where('id', $id)->first();

        return view('cp/members/cp_addmember')->with(compact('certainMem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //UPDATE MEMBER'S INFO
    public function update(Request $request, $id)
    {
        $validations = 
        [
            "memname"=>"required",
            "email"=>"required",
            "blockdatafield"=>"integer|nullable",
            "blockipdatafield"=>"integer|nullable"
        ];


        $validationMSG = 
        [
            "memname.required" =>"Member name is required",
            "email.required" =>"Member email is required",
            "blockdatafield.integer" =>"Block period must be an integer",
            "blockipdatafield.integer" =>"Block period must be an integer"
        ];


        $this->validate($request, $validations, $validationMSG);

        if($request->blockipdatafield != '')
        {
            $bl1 = round(microtime(true) * 1000);
            $bl2 = $request->blockipdatafield * 86400000;
            $block = $bl1 + $bl2;
        }
        else
        {
            $block = '';
        }

        $user = User::where('email', $request->email)->get();

        if(!$user[0]->ip_address && $request->blockipdatafield != '')
        {
            session()->flash('err_message', 'There is no IP address for this member in our records');
            return back();
        }
        else
        {

            if(count($user) == 1)
            {
                if($id == $user[0]->id)
                {
                    if($request->mempass == '')
                    {

                        if($request->blockipdatafield != '')
                        {

                            User::where('id',$id)->update(
                            [
                                    "name"=> $request->memname,
                                    "email"=> $request->email,
                                    "block"=> $block,
                            ]);
                        
                            $findip = Blockedip::where("ip_address", $user[0]->ip_address)->first();

                            if($findip->ip_address && $findip->ip_address != '')
                            {
                                Blockedip::where("ip_address", $user[0]->ip_address)->update
                                ([
                                    "ip_address"=>$user[0]->ip_address,
                                ]);
                            }
                            else
                            {
                                Blockedip::create([

                                    "ip_address"=>$user[0]->ip_address,
                                ]);
                            }
                        }
                        else
                        {
                            User::where('id',$id)->update(
                            [
                                    "name"=> $request->memname,
                                    "email"=> $request->email,
                                    "block"=> $block,
                            ]);
                        }
                        
                
        
                            session()->flash('success_message', 'Member information has updated successfully');
                            return redirect(route('cp_managemem.index'));
                        
                    }
                    else
                    {
                        if($request->blockipdatafield != '')
                        {

                            User::where('id',$id)->update(
                            [
                                "name"=> $request->memname,
                                "email"=> $request->email,
                                "block"=> $block,
                                "password"=> Hash::make($request->mempass)
                            ]);
                            
                            $findip = Blockedip::where("ip_address", $user[0]->ip_address)->first();
                            
                            if($findip->ip_address && $findip->ip_address != '')
                            {
                                Blockedip::where("ip_address", $user[0]->ip_address)->update
                                ([
                                    "ip_address"=>$user[0]->ip_address,
                                ]);
                            }
                        }
                        else
                        {  

                            User::where('id',$id)->update(
                            [
                                "name"=> $request->memname,
                                "email"=> $request->email,
                                "block"=> $block,
                                "password"=> Hash::make($request->mempass)
                            ]);
                        
                        }

                            session()->flash('success_message', 'Member information has updated successfully');
                            return redirect(route('cp_managemem.index'));   
                    }
                }
                else
                {
                    session()->flash('err_message', 'This email is already in use');
                    return back();
                }
            }
            else
            {
                session()->flash('err_message', 'An error happened');
                return back();
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::where('id', $id)->delete();

        session()->flash('success_message', 'Member has been deleted successfully');
        return redirect(route('cp_managemem.index'));
    }

    public function searchMember(Request $request)
    {

        if(isset($request->input))
        {
            $input = $request->input;
            $option = $request->option;

            $searchresult = User::where($option, 'LIKE', '%'.$input.'%')->get();
        }
        else
        {
            $option = $request->option;

            $searchresult = User::where("block", '<>', '')->get();
        }

        return $searchresult;

    }

    public function unblock($id)
    {

        $memberinfo = User::where('id', $id)->first();
        $requestedip = $memberinfo->ip_address;

        Blockedip::where('ip_address', $requestedip)->delete();
        User::where('ip_address', $requestedip)->update([

            "block"=>NULL
        ]);

        session()->flash('success_message', 'This member and his IP has been unblocked successfully');
        return back();

    }
}
