<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use Image;
use Session;

class sitesettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteinfo = Site::where('id', 1)->first();

        return view('cp/sitesettings')->with(compact('siteinfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validations = [
            "favicon"=>"mimes:png, jpg, gif|max:999999999999999|nullable",
        ];
        $validationMSG = [
            "favicon.mimes"=>"Favicon format must be png, jpg or gif",
        ];

        $this->validate($request, $validations, $validationMSG);

        if($request->hasFile('favicon'))
        {
            $temp_img = $request->file('favicon');
            $ext = $temp_img->getClientOriginalExtension();
            $img_name = 'fav_'.rand(111111111111111, 999999999999999).'.'.$ext;
            $img_path = 'public/images/favicons/'.$img_name;
            image::make($temp_img)->save($img_path);
        }
        else
        {
            $img_path = '';
        }

        Site::where('id', 1)->update(
        [

            'sitename' => $request->sitename,
            'footerabout'=>$request->footerabout,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'vimo' => $request->vimo,
            'favicon'=>$img_path,

        ]);

        session()->flash('success_message', 'Information has been updated successfully');
        return back();
    }

    public function settingsshow()
    {
        Session::put('page', 'comment');
        $siteset = Site::where('id', 1)->first();
        

        if(isset($siteset))
        {
            $facecode = explode("AniMasTER4g3t319edoc670a4g84AniMASTer", $siteset->facecomcode);
            return view('cp.comments.cp_commentsettings')->with(compact('siteset', 'facecode'));


        }
        else
        {
            return view('cp.comments.cp_commentsettings');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commentsettingsave(Request $request)
    {
        if($request->activefacebook == "Yes" && $request->facemaincode == '')
        {
            session()->flash('err_message', 'Facebook comments plugin code is required');
            return back();
        }
        else
        {
            if($request->facemaincode != '' && $request->facelocalcode == '')
            {
                session()->flash('err_message', 'Facebook comments plugin code is required');
                return back();
            }
            else
            {
                
                if($request->facemaincode == '' && $request->facelocalcode != '')
                {
                    session()->flash('err_message', 'Facebook comments plugin code is required');
                    return back();
                }
                else
                {

                    $validations=
                    [
                        "activefacebook"=>'required',
                        "activesitecom"=>'required',

                    ];

                    $validationsMSG =
                    [
                        "activefacebook.required"=>'Something went wrong, please try again',
                        "activesitecom.required"=>'Something went wrong, please try again',
                    ];

                    $this->validate($request, $validations, $validationsMSG);

                    if(isset($request->facemaincode) && $request->facemaincode != NULL)
                    {
                        $facecode = $request->facemaincode .'AniMasTER4g3t319edoc670a4g84AniMASTer'.$request->facelocalcode;
                    }
                    else
                    {
                        $facecode='';
                    }

                    $sitesettingrec = count(Site::all());
                    

                    if($sitesettingrec == 0)
                    {
                        Site::create(['id'=>1]);
                    }

                    
                    Site::where('id', 1)->update([

                        "facebookcomments" => $request->activefacebook,
                        "localcomments" => $request->activesitecom,
                        "facecomcode" => $facecode,

                    ]);

                    session()->flash('success_message', 'Settings saved successfully');
                    return back();
        }
        }
    }
    }
}
