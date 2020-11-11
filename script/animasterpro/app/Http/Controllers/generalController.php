<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Page;
use App\Series;
use App\Post;
use App\Site;
use App\Comment;

class generalController extends Controller
{
    //SHOW MAIN INDEX PAGE WITH MULTI DATA
    public function index(Request $request)
    {
        $cates = Category::all();
        $pages = Page::orderBy("pagesorder", "asc")->get();
        $series = Series::all();
        $slider = Series::orderBy('id', 'desc')->take(3)->get();
        $latestposts= Post::orderBy('id', 'desc')->take(24)->get();
        $popposts = Post::orderBy('views', 'desc')->take(24)->get();


        return view('index')->with(compact('cates', 'pages', 'series', 'slider', 'latestposts', 'popposts'));
        
    }

    //SHOW DOWNLOAD PAGE
    public function showdownloadpage($id)
    {
        $cates = Category::all();
        $pages = Page::all();
        $series = Series::all();
        $sitename = Site::where('id', 1)->first()->sitename;
        $thispost = Post::where('id', $id)->first();
       
        //CHECK IF THERE ARE DOWNLOAD FORIEGN DOWNLOAD LINKS
        if(!empty($thispost->downserversname))
        {
            $downserversnamefinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->downserversname);
            $downserverslinkfinal = explode("*/-)917315^AniMaSTerSerViCE!8419zLwM", $thispost->downserverslink);
            $downserversnamefinal = array_filter($downserversnamefinal);
            $downserverslinkfinal = array_filter($downserverslinkfinal);
            $downsercount = count($downserversnamefinal);
        }
        else
        {
            $downsercount='';
            $downserversnamefinal='';
            $downserverslinkfinal='';
        }


        return view('download')->with(compact('cates', 'pages', 'series', 'thispost', 'downserversnamefinal', 'downserverslinkfinal', 'downsercount', 'sitename'));
    }

    //MAIN SEARCH FUNCTION (HEADER)
    public function search(Request $request)
    {
        $cates = Category::all();
        $pages = Page::all();

        $validations = 
        [
            "searchvalue"=>"required|regex:/(^[A-Za-z0-9 ]+$)+/"
        ];


        $validationMSG = 
        [
            "searchvalue.required" =>"No search entry has been inserted!",
            "searchvalue.regex" =>"The data you entered is not allowed, letters, numbers and spaces only are allowed"
        ];


        $this->validate($request, $validations, $validationMSG);


        $searchtext = $request->searchvalue;
        $searchresults = Post::where('title', 'LIKE', '%'.$searchtext.'%')->orWhere('content', 'LIKE', '%'.$searchtext.'%')->paginate(10);

        return view('search')->with(compact('searchtext', 'searchresults', 'cates', 'pages'));
    }

}
