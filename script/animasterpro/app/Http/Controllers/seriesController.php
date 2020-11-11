<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Series;
use App\Category;
use App\Post;
use App\Page;
use Image;

class seriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'series');

        $serList = Series::paginate(10);

        if(count($serList) == 0)
        {
            $emptyser = "0";
            return view('cp/series/cp_series')->with(compact(['emptyser']));
        }
        else
        {
            return view('cp/series/cp_series')->with(compact('serList')); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page', 'series');
        
        $cates = Category::all();

        return view('cp/series/cp_addseries')->with(compact('cates')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validations = [

            "seriesname" =>"required|unique:series",
            "catelist" => "required",
            "postimgup"=>"mimes:jpeg,jpg,png|max:999999999999999|required",

        ];

        $validationMSG = [

            "seriesname.required" =>"Series name field is empty",
            "seriesname.unique" =>"Series name is already in use",
            "catelist.required" => "No category has been chosen",
            "postimgup.mimes"=>"Image format must be jpeg, jpg, png",
            "postimgup.required"=>"Series image is required",
        ];
        $this->validate($request, $validations, $validationMSG);

        $category_id = Category::where("catename", $request->catelist)->first();
        $category_id= $category_id->id;

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
                if($request->has('postimgup'))
                {
                    $temp_img = $request->file('postimgup');
                    $img_ex = $temp_img->getClientOriginalExtension();
                    $img_name = 'simg_'.rand(111111111111111, 999999999999999).'.'.$img_ex;
                    $img_path = 'public/images/series_images/'.$img_name;
                    image::make($temp_img)->save($img_path);
                    $image_src = 'native';
                }
                else
                {
                    $image_src = 'foreign';
                    $img_path = $img_path = $request->postimglink;
                }

                Series::create([
                    "category_id"=> $category_id,
                    "seriesname"=> $request->seriesname,
                    "image"=> $img_path,
                    "image_src"=> $image_src,
                    "content"=> $request->sercontent,
                ]);

                Session()->flash('success_message', 'Series has been created successfully');
                return redirect(route('cp_series.index'));
            
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
        $cates = Category::all();
        $pages = Page::all();
        $series = Series::all();
        $thispost = Post::where('id', $id)->first();
        $thisseries = Series::where('id', $thispost->series_id)->first();
        $seriesposts = Post::where('series_id', $thisseries->id)->orderBy('epn', 'asc')->get();


        return view('series')->with(compact('cates', 'pages', 'series', 'thisseries', 'thispost', 'seriesposts')); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('page', 'series');

        $certainSer = Series::where('id', $id)->first();
        $cates = Category::all();

        return view('cp/series/cp_addseries')->with(compact('certainSer', 'cates'));
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

            "seriesname" =>"required",
            "catelist" => "required",
            "postimgup"=>"mimes:jpeg,jpg,png|max:999999999999999|nullable",

        ];

        $validationMSG = [

            "seriesname.required" =>"Series name field is empty",
            "catelist.required" => "No category has been chosen",
            "postimgup.mimes"=>"Image format must be jpeg, jpg, png",
        ];

        $this->validate($request, $validations, $validationMSG);

        $category_id = Category::where("catename", $request->catelist)->first();
        $category_id= $category_id->id;

        if($request->postimglink && $request->hasFile('postimgup'))
        {
            Session()->flash('err_message', 'You must choose one way only to insert Image');
            return back();
        }
        else
        {
                if($request->has('postimgup'))
                {
                    $temp_img = $request->file('postimgup');
                    $img_ex = $temp_img->getClientOriginalExtension();
                    $img_name = 'simg_'. rand(111111111111111, 999999999999999) . '.'. $img_ex;
                    $img_path = 'public/images/series_images/'.$img_name;
                    image::make($temp_img)->save($img_path);
                    $image_src = 'native';

                    Series::where('id', $id)->update([
                        "category_id"=> $category_id,
                        "seriesname"=> $request->seriesname,
                        "image"=> $img_path,
                        "image_src"=> $image_src,
                        "content"=> $request->sercontent,
                        
                    ]); 
                    

                    Session()->flash('success_message', 'Series has been updated successfully');
                    return redirect(route('cp_series.index'));
                }
                elseif($request->postimglink)
                {
                    $image_src = 'foreign';
                    $img_path = $img_path = $request->postimglink;

                    Series::where('id', $id)->update([
                        "category_id"=> $category_id,
                        "seriesname"=> $request->seriesname,
                        "image"=> $img_path,
                        "image_src"=> $image_src,
                        "content"=> $request->sercontent,
                        
                    ]); 

                    Session()->flash('success_message', 'Series has been updated successfully');
                    return redirect(route('cp_series.index'));
                }
                else
                {

                    Series::where('id', $id)->update([
                        "category_id"=> $category_id,
                        "seriesname"=> $request->seriesname,
                        "content"=> $request->sercontent,
                        
                    ]); 

                    Session()->flash('success_message', 'Series has been updated successfully');
                    return redirect(route('cp_series.index'));

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
        $sername = Series::where("id", $id)->first();

        //change posts series to "has no series"
        Post::where("series_id", $id)->update([

            "series_id" => "0"
            
        ]);

        //Delete series
        Series::where('id', $id)->delete();


        //Back
        session()->flash('success_message', $sername->seriesname.' series has been removed successfully');
        return back();
        
    }
}
