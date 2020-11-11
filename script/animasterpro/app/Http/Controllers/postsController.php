<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Post;
use App\Category;
use App\Series;
use App\Page;
use App\Site;
use App\Comment;
use App\Admin;
use App\Blockedip;
use App\User;
use Image;
use Paginate;
use Auth;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'posts');

        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        if(count($posts) == 0)
        {
            $emptypost = "0";
            return view("cp/posts/index")->with(compact(['posts', 'emptypost']));
        }
        else
        {
            return view("cp/posts/index")->with(compact('posts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page', 'posts');

        $seriesList = Series::all();

        $cates = Category::all();
        return view('cp/posts/addpost')->with(compact('cates', 'seriesList'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validations = 
        [
            "title" => "required|min:5|unique:posts",
            "epn" => "required|integer",
            "postvidup"=>"mimes:mp4,ogx,oga,ogv,ogg,webm|max:999999999999999|nullable",
            "postvidlink"=>"url|nullable",
            "downlink"=>"url|nullable",
            "postimgup"=>"mimes:jpeg,jpg,png|max:999999999999999",
            "catelist"=>"required",
        ];


        $validationMSG =
        [
            "title.min"=>"Subject should not be lesser than 5 characters",
            "title.required"=>"Subject is required",
            "title.unique"=>"Subject must be unique",
            "epn.required"=>"Episode number is required",
            "epn.integer"=>"Episode number must be integer",
            "postvidup.mimes"=>"Video format must be mp4,ogx,oga,ogv,ogg or webm",
            "postvidlink.url"=>"Please enter a valid url",
            "downlink.url"=>"Please enter a valid url",
            "postimgup.mimes"=>"Image format must be jpeg,jpg,png",
            "catelist.required"=>"No category has been chosen",
        ];


        $this->validate($request, $validations, $validationMSG);

    
       
        if(!$request->servername && !$request->hasFile('postvidup'))
        {
            Session()->flash('err_message', 'No video has been inserted');
            return back();
        }
        else
        {
            if($request->postimglink && $request->hasFile('postimgup'))
            {
                Session()->flash('err_message', 'You must choose one way only to insert Image');
                return back();
            }
            else
            {
                if(!$request->postimglink && !$request->hasFile('postimgup'))
                {
                    Session()->flash('err_message', 'No image has been inserted');
                    return back();
                }
                else
                {
                    $requestwservername = $request->servername;
                    $requestwservercode = $request->vidcode;

                    if(count(array_filter($requestwservername)) !== count(array_filter($requestwservercode)))
                    {
                        
                        Session()->flash('err_message', 'You missed something in remote hosts field');
                        return back();
                    }
                    else
                    {
                        $requestservnameval = $request->servnameval;
                        $requestpostvidlinkdwname = $request->postvidlinkdwname;
                        
                        if(count(array_filter($requestservnameval)) !== count(array_filter($requestpostvidlinkdwname)))
                        {
                
                                Session()->flash('err_message', 'You missed something in download links');
                                return back();
                        }
                        else
                        {
                            
                            if($request->selectvidtype == "Yes" && $request->selectseries == '')
                            {
                                    Session()->flash('err_message', 'You forgot to choose a series');
                                    return back();
                            }

                            else
                            {
    
                                if($request->dwoption == "Yes" && empty(array_filter($request->servnameval)) && empty($request->file('postvidup')))
                                {
                                    Session()->flash('err_message', 'You provided no material for download, there is no download link or uploaded video');
                                    return back();
                                }
                                else
                                {
                                      
                                    if(!empty(array_filter($requestwservername)))
                                    {
                                        //Add prefix to each value of watching servers names
                                        $watchserversnamefinal = '';
                                        $watchserversname = array_filter($request->servername);
                                        for($i=0; $i<count($watchserversname); $i++)
                                        {
                                            $watchserversname[$i] = $watchserversname[$i] . '*/-)917315^AniMaSTerSerViCE!8419zLwM';
                                            $watchserversnamefinal .= $watchserversname[$i];
                                        }

                                        //Add prefix to each value of watching servers codes
                                        $watchserverscodefinal = '';
                                        $watchserverscode = array_filter($request->vidcode);
                                        for($i=0; $i<count($watchserverscode); $i++)
                                        {
                                            $watchserverscode[$i] = $watchserverscode[$i] . '*/-)917315^AniMaSTerSerViCE!8419zLwM';
                                            $watchserverscodefinal .= $watchserverscode[$i];
                                        }


                                    }
                                    else
                                    {
                                        $watchserversnamefinal = '';
                                        $watchserverscodefinal = '';
                                    }

                                    if(!empty(array_filter($request->servnameval)))
                                    {

                                        //Add prefix to each value of Down servers names
                                        $downserversnamefinal = '';
                                        $downserversname = array_filter($request->servnameval);
                                        for($i=0; $i<count($downserversname); $i++)
                                        {
                                            $downserversname[$i] = $downserversname[$i] . '*/-)917315^AniMaSTerSerViCE!8419zLwM';
                                            $downserversnamefinal .= $downserversname[$i];
                                        }

                                        //Add prefix to each value of Down servers codes
                                        $downserverslinkfinal = '';
                                        $downserverslink = array_filter($request->postvidlinkdwname);
                                        for($i=0; $i<count($downserverslink); $i++)
                                        {
                                            $downserverslink[$i] = $downserverslink[$i] . '*/-)917315^AniMaSTerSerViCE!8419zLwM';
                                            $downserverslinkfinal .= $downserverslink[$i];
                                        }


                                    }
                                    else
                                    {
                                        $downserversnamefinal = '';
                                        $downserverslinkfinal = '';
                                    }
                               
                                    if($request->hasFile('postimgup'))
                                    {
                                        $img_temp = $request->file('postimgup');
                                        $img_exten = $img_temp->getClientOriginalExtension();
                                        $img_name = 'img_'.rand(111111111111111, 999999999999999).'.'.$img_exten;
                                        $img_path = 'public/images/posts_images/'.$img_name;
                                        image::make($img_temp)->save($img_path);
                                        $img_src = 'native';
                                    }
                                    elseif($request->postimglink)
                                    {
                                        $img_src = 'foreign';
                                        $img_path = $request->postimglink;
                                    }

                                    if($request->file('postvidup'))
                                    {
                                        $vid_temp = $request->file('postvidup');
                                        $vid_exten = $vid_temp->getClientOriginalExtension();
                                        $vid_name = 'vid_'.rand(111111111111111, 999999999999999).'.'.$vid_exten;
                                        $vid_path = 'public/storage/';
                                        $vid_temp->move($vid_path, $vid_name);
                                        $vid = $vid_path.$vid_name;

                                    }
                                    else
                                    {
                                        $vid = '';
                                        $vid_exten ='';
                                    }
                                    

                                    $category_id = Category::where('catename', $request->catelist)->first()->id;

                                    if($request->selectseries != null)
                                    {
                                        $series_id = Series::where('seriesname', $request->selectseries)->first()->id;

                                    }
                                    else
                                    {
                                        $series_id = '000';
                                    }
                                    


                                    Post::create([
                                        "category_id"=>$category_id,
                                        "series_id" => $series_id,
                                        "title"=>$request->title,
                                        "epn"=>$request->epn,
                                        "content"=>$request->postcontent,
                                        "upvideo"=>$vid,
                                        "videxten"=>$vid_exten,
                                        "watchserversname"=>$watchserversnamefinal,
                                        "watchserverscode"=>$watchserverscodefinal,
                                        "downserversname"=>$downserversnamefinal,
                                        "downserverslink"=>$downserverslinkfinal,
                                        "downloadoption"=>$request->dwoption,
                                        "image"=>$img_path,
                                        "image_src"=>$img_src,
                                        "tags"=>$request->posttags,
                                    ]);

                                        Session()->flash('success_message', 'Post has been created successfully');
                                        return redirect(route('cp_posts.index'));
                                        
                                }
                            
                            }
                        
                        }

                        
                    }
                } 
                
            }
        }     
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $sitename = Site::where('id', 1)->first()->sitename;
        $cates = Category::all();
        $pages = Page::all();
        $series = Series::all();
        $thispost = Post::where('id', $id)->first();
        $postcomments = $thispost->comments;
        $seriesposts = Post::where('series_id', $thispost->series_id)->orderBy('epn', 'asc')->get();
        $memberid = Auth::id();

        //Get the watcher member
        $watcher = User::where('id', Auth::id())->first();

        //Get the watcher IP
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

        //Prevent the blocked member and IP
        //1- First check if this IP is blocked
        $findipinblockedips = Blockedip::where('ip_address', $ip)->first();

        if($findipinblockedips)
        {
            //2- Check if block period has finished or not
            $blockperiod = User::where("ip_address", $findipinblockedips->ip_address)->orderBy('block', 'desc')->get();
            
            $timenow = round(microtime(true) * 1000);
            
            if($blockperiod[0]->block > $timenow)
            {
                $blockedmember = 1;
            }

            else
            {
                User::where("ip_address", $findipinblockedips)->update([

                    "block"=>null
                ]);

                Blockedip::where("ip_address", $findipinblockedips)->delete();


                $blockedmember = 0;
            }

        }
        else
        {
            $blockedmember = 0;
        }


        if(Auth::guard('admin')->check())
        {
            $adminauth = 1;
        }
        else
        {
            $adminauth = 0;
        }

        Post::where('id', $id)->update(
        [
            "views" => $thispost->views + 1,
        ]);



        if(!empty($thispost->downserversname) && !empty($thispost->watchserversname))
        {
            
            $downserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->downserversname);
            $downserverslinkfinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->downserverslink);
            $downserversnamefinal = array_filter($downserversnamefinal);
            $downserverslinkfinal = array_filter($downserverslinkfinal);
            $downsercount = count($downserversnamefinal);

            $watchserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->watchserversname);
            $watchserverscodefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->watchserverscode);
            $watchserversnamefinal = array_filter($watchserversnamefinal);
            $watchserverscodefinal = array_filter($watchserverscodefinal);
            $watchsercount = count($watchserversnamefinal);

        }
        elseif(empty($thispost->downserversname) && !empty($thispost->watchserversname))
        {

            $watchserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->watchserversname);
            $watchserverscodefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->watchserverscode);
            $watchserversnamefinal = array_filter($watchserversnamefinal);
            $watchserverscodefinal = array_filter($watchserverscodefinal);
            $watchsercount = count($watchserversnamefinal);

            
            $downsercount='';
            $downserversnamefinal='';
            $downserverslinkfinal='';

        }

        elseif(!empty($thispost->downserversname) && empty($thispost->watchserversname))
        {
            $downserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->downserversname);
            $downserverslinkfinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->downserverslink);
            $downserversnamefinal = array_filter($downserversnamefinal);
            $downserverslinkfinal = array_filter($downserverslinkfinal);
            $downsercount = count($downserversnamefinal);

            $watchsercount='';
            $watchserversnamefinal='';
            $watchserverscodefinal='';


        }
        elseif(empty($thispost->downserversname) && empty($thispost->watchserversname))
        {
            $downsercount='';
            $downserversnamefinal='';
            $downserverslinkfinal='';

            $watchsercount='';
            $watchserversnamefinal='';
            $watchserverscodefinal='';

        }


        return view('watch')->with(compact('sitename', 'cates', 'pages', 'series', 'thispost', 'seriesposts', 'downsercount', 'downserversnamefinal', 'downserverslinkfinal', 'watchsercount', 'watchserversnamefinal', 'watchserverscodefinal', 'postcomments', 'adminauth', 'blockedmember')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requestedpost = Post::where("id", $id)->first();
        $cates = Category::all();
        $seriesList = Series::all();

        if($requestedpost->series_id != '')
        {
            $seriesName = $requestedpost->series->seriesname;
        }
        else
        {
            $seriesName = '';
        }

        if(!empty($requestedpost->downserversname) && !empty($requestedpost->watchserversname))
        {
            
            $downserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $requestedpost->downserversname);
            $downserverslinkfinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $requestedpost->downserverslink);
            $downserversnamefinal = array_filter($downserversnamefinal);
            $downserverslinkfinal = array_filter($downserverslinkfinal);
            $downsercount = count($downserversnamefinal);

            $watchserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $requestedpost->watchserversname);
            $watchserverscodefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $requestedpost->watchserverscode);
            $watchserversnamefinal = array_filter($watchserversnamefinal);
            $watchserverscodefinal = array_filter($watchserverscodefinal);
            $watchsercount = count($watchserversnamefinal);


        }
        elseif(empty($requestedpost->downserversname) && !empty($requestedpost->watchserversname))
        {

            $watchserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $requestedpost->watchserversname);
            $watchserverscodefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $requestedpost->watchserverscode);
            $watchserversnamefinal = array_filter($watchserversnamefinal);
            $watchserverscodefinal = array_filter($watchserverscodefinal);
            $watchsercount = count($watchserversnamefinal);

            
            $downsercount='';
            $downserversnamefinal='';
            $downserverslinkfinal='';


        }

        elseif(!empty($requestedpost->downserversname) && empty($requestedpost->watchserversname))
        {
            $downserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $requestedpost->downserversname);
            $downserverslinkfinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $requestedpost->downserverslink);
            $downserversnamefinal = array_filter($downserversnamefinal);
            $downserverslinkfinal = array_filter($downserverslinkfinal);
            $downsercount = count($downserversnamefinal);

            $watchsercount='';
            $watchserversnamefinal='';
            $watchserverscodefinal='';


        }
        elseif(empty($requestedpost->downserversname) && empty($requestedpost->watchserversname))
        {
            $downsercount='';
            $downserversnamefinal='';
            $downserverslinkfinal='';

            $watchsercount='';
            $watchserversnamefinal='';
            $watchserverscodefinal='';

        }


        return view('cp/posts/addpost')->with(compact('requestedpost', 'cates', 'seriesList', 'seriesName', 'downsercount', 'downserversnamefinal', 'downserverslinkfinal', 'watchsercount', 'watchserversnamefinal', 'watchserverscodefinal')); 

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
        
        $validations = 
        [
            "title" => "required|min:5",
            "epn" => "required|integer",
            "postvidup"=>"mimes:mp4,ogg,webm|max:999999999999999|nullable",
            "postvidlink"=>"url|nullable",
            "downlink"=>"url|nullable",
            "postimgup"=>"mimes:jpeg,jpg,png|max:999999999999999",
            "catelist"=>"required",
        ];


        $validationMSG =
        [
            "title.min"=>"Subject should not be lesser than 5 characters",
            "title.required"=>"Subject is required",
            "title.required"=>"Subject is required",
            "epn.required"=>"Episode number is required",
            "epn.integer"=>"Episode number must be integer",
            "postvidup.mimes"=>"Video format must be mp4,ogx,oga,ogv,ogg or webm",
            "postvidlink.url"=>"Please enter a valid url",
            "downlink.url"=>"Please enter a valid url",
            "postimgup.mimes"=>"Image format must be jpeg,jpg,png",
            "catelist.required"=>"No category has been chosen",
        ];

        $this->validate($request, $validations, $validationMSG);

        $uppost = Post::where('id', $id)->first();
        $postvid = Post::where('id', $id)->first()->upvideo;

        //Check if post has two images
        if($request->postimglink && $request->hasFile('postimgup'))
        {
            Session()->flash('err_message', 'You must choose one way only to insert Image');
            return back();
        }

        else
        {

            $requestwservername = $request->servername;
            $requestwservercode = $request->vidcode;
            //Check if Servers name and View codes are not equal
            if(count(array_filter($requestwservername)) !== count(array_filter($requestwservercode)))
            {
                
                Session()->flash('err_message', 'You missed something in remote hosts field');
                return back();
            }
                else
                {
                    $requestservnameval = $request->servnameval;
                    $requestpostvidlinkdwname = $request->postvidlinkdwname;

                    //Check if Download Server names and codes are equal or not
                    if(count(array_filter($requestservnameval)) !== count(array_filter($requestpostvidlinkdwname)))
                    {
            
                            Session()->flash('err_message', 'You missed something in download links');
                            return back();
                    }
                    else
                    {
                        //Check if Series is selected if the has series option = yes
                        if($request->selectvidtype == "Yes" && $request->selectseries == '')
                        {
                                Session()->flash('err_message', 'You forgot to choose a series');
                                return back();
                        }

                        else
                        {
                            if($request->dwoption == "Yes" && empty(array_filter($request->servnameval)) && empty($request->file('postvidup')))
                            {
                                Session()->flash('err_message', 'No video or links has been provided for download');
                                return back();
                            }
                            else
                            {
                                        $postoldtitle = Post::where("id", $id)->first()->title;
                                        $foundtitle = Post::where('title', $postoldtitle)->first()->title;
                                        $foundid = Post::where('title', $postoldtitle)->first()->id;
                                        
                                        if($request->title ==  $foundtitle && $id != $foundid)
                                        {
                                            Session()->flash('err_message', 'Post subject must be unique');
                                            return back();
                                        }
                                        else
                                        {
                            
                                            if($request->selectvidtype == "No")
                                            {
                                                $series_id = '0';
                                            }
                            
                                            if(!empty(array_filter($requestwservername)))
                                            {
                                                //Add prefix to each value of watching servers names
                                                $watchserversnamefinal = '';
                                                $watchserversname = array_filter($request->servername);
                                                for($i=0; $i<count($watchserversname); $i++)
                                                {
                                                    $watchserversname[$i] = $watchserversname[$i] . '*/-)917315^AniMaSTerSerViCE!8419zLwM';
                                                    $watchserversnamefinal .= $watchserversname[$i];
                                                }
        
                                                //Add prefix to each value of watching servers codes
                                                $watchserverscodefinal = '';
                                                $watchserverscode = array_filter($request->vidcode);
                                                for($i=0; $i<count($watchserverscode); $i++)
                                                {
                                                    $watchserverscode[$i] = $watchserverscode[$i] . '*/-)917315^AniMaSTerSerViCE!8419zLwM';
                                                    $watchserverscodefinal .= $watchserverscode[$i];
                                                }
        
        
                                            }
                                            else
                                            {
                                                $watchserversnamefinal = '';
                                                $watchserverscodefinal = '';
                                            }
        
                                            if(!empty(array_filter($request->servnameval)))
                                            {
        
                                                //Add prefix to each value of Down servers names
                                                $downserversnamefinal = '';
                                                $downserversname = array_filter($request->servnameval);
                                                for($i=0; $i<count($downserversname); $i++)
                                                {
                                                    $downserversname[$i] = $downserversname[$i] . '*/-)917315^AniMaSTerSerViCE!8419zLwM';
                                                    $downserversnamefinal .= $downserversname[$i];
                                                }
        
                                                //Add prefix to each value of Down servers codes
                                                $downserverslinkfinal = '';
                                                $downserverslink = array_filter($request->postvidlinkdwname);
                                                for($i=0; $i<count($downserverslink); $i++)
                                                {
                                                    $downserverslink[$i] = $downserverslink[$i] . '*/-)917315^AniMaSTerSerViCE!8419zLwM';
                                                    $downserverslinkfinal .= $downserverslink[$i];
                                                }
        
        
                                            }
                                            else
                                            {
                                                $downserversnamefinal = '';
                                                $downserverslinkfinal = '';
                                            }

                                                if($request->hasFile('postimgup'))
                                                {
                                                    $img_temp = $request->file('postimgup');
                                                    $img_exten = $img_temp->getClientOriginalExtension();
                                                    $img_name = 'img_'.rand(111111111111111, 999999999999999).'.'.$img_exten;
                                                    $img_path = 'public/images/posts_images/'.$img_name;
                                                    image::make($img_temp)->save($img_path);
                                                    $img_src = 'native';
                                                }
                                                elseif($request->postimglink)
                                                {
                                                    $img_src = 'foreign';
                                                    $img_path = $request->postimglink;
                                                }

                                                if($request->file('postvidup'))
                                                {
                                                    $vid_temp = $request->file('postvidup');
                                                    $vid_exten = $vid_temp->getClientOriginalExtension();
                                                    $vid_name = 'vid_'.rand(111111111111111, 999999999999999).'.'.$vid_exten;
                                                    $vid_path = 'storage/';
                                                    $vid_temp->move($vid_path, $vid_name);
                                                    $vid = $vid_path.$vid_name;

                                                }
                                                else
                                                {
                                                    $vid = '';
                                                    $vid_exten ='';
                                                }
                                                

                                                $category_id = Category::where('catename', $request->catelist)->first()->id;

                                                if($request->selectseries != null)
                                                {
                                                    $series_id = Series::where('seriesname', $request->selectseries)->first()->id;

                                                }
                                                else
                                                {
                                                    $series_id = '000';
                                                }
                                                if($request->selectvidtype == "No")
                                                {
                                                    $series_id = '000';
                                                }

                                                $postimage = Post::where('id', $id)->first()->image;
                                                $postimgsrc = Post::where('id', $id)->first()->image_src;

                                                if(!$request->postimglink && !$request->hasFile('postimgup'))
                                                {
                                                    $img_path = $postimage;
                                                    $img_src = $postimgsrc;
                                                }


                                                if(empty($vid) && empty($watchserversname) && empty($postvid))
                                                {
                                                    Session()->flash('err_message', 'No video has been provided');
                                                    return back();
                                                }
                                                else
                                                {

                                                    if(empty($vid) && empty($watchserversname) && $request->selectrmkvid == "no")
                                                    {
                                                        Session()->flash('err_message', 'No video has been provided');
                                                        return back();
                                                    }
                                                    else
                                                    {
                                                        if(!isset($vid))
                                                        {
                                                            $vid = $postvid;
                                                        }
                                                        
                                                        Post::where('id', $id)->update([
                                                            "category_id"=>$category_id,
                                                            "series_id" => $series_id,
                                                            "title"=>$request->title,
                                                            "epn"=>$request->epn,
                                                            "content"=>$request->postcontent,
                                                            "upvideo"=>$vid,
                                                            "videxten"=>$vid_exten,
                                                            "watchserversname"=>$watchserversnamefinal,
                                                            "watchserverscode"=>$watchserverscodefinal,
                                                            "downserversname"=>$downserversnamefinal,
                                                            "downserverslink"=>$downserverslinkfinal,
                                                            "downloadoption"=>$request->dwoption,
                                                            "image"=>$img_path,
                                                            "image_src"=>$img_src,
                                                            "tags"=>$request->posttags,
                                                            ]);
                                                            

                                                            Session()->flash('success_message', 'Post has been updated successfully');
                                                            return redirect(route('cp_posts.index'));
                                                
                                        
                                         }
                                    }
                            
                                }
                        
                            }
                        }

                        }
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
        Post::where("id", $id)->first()->delete();

        Session()->flash('success_message', 'Post has been deleted successfully');
        return redirect(route('cp_posts.index'));
    }

    public function getseriescategory()
    {
        $selectedser = $_GET['selectedser'];

        if($selectedser == '')
        {
            $allcates = Category::get("catename");
            $arr=[];
            
            for($i=0; $i<count($allcates); $i++)
            {
                array_push($arr, $allcates[$i]['catename']);
            }

            $finalarr = implode(' ', $arr);
            echo $finalarr;

        }
        else
        {
            $sercate = Series::where('seriesname', $selectedser)->first();
            $sercate = $sercate->Category->catename;
            echo $sercate;
        }
    }

}
