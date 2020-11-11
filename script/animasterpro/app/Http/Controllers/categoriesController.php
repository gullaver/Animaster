<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Admin;
use App\Post;
use App\Series;
use App\Page;
use Auth;
use Session;
use Paginate;


class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //SHOW INDEX PAGE
    public function index()
    {
        Session::put('page','cates');
        $catesList = Category::paginate(10);

        if(count($catesList) == 0)
        {
            $emptycate = "0";
            return view('cp/categories/cp_categories')->with(compact(['catesList', 'emptycate']));
        }
        else
        {
            return view('cp/categories/cp_categories')->with(compact('catesList')); 
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //SHOW CREATE NEW CATEGORY PAGE
    public function create()
    {
        Session::put('page','cates');
        return view('cp/categories/cp_addcategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //STORE NEW CATEGOTY
    public function store(Request $request)
    {
        $validations = 
        [
            "catename"=>"required|unique:categories",
        ];


        $validationMSG= 
        [
            "catename.required" =>"Category name can't be empty",
            "catename.unique" =>"This category is already in use",
        ];

        $this->validate($request, $validations, $validationMSG);

        if($request->catename == 'uncategorized')
        {
            session()->flash('err_message', 'Category name is not allowed');
            return back();
        }
        else
        {

            $Category = new Category;
            $Category->catename = $request->catename;
            $Category->catedesc = $request->catedesc;
            $Category->save();

            $CateId = Category::where('catename', $request['catename'])->first()->id;


            session()->flash('success_message', 'Category has been created successfully');
            return redirect(route('cp_categories.index'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //SHOW CATEGORY CONTENTS IN THE PUBLIC CONTENT (NOT CP)
    public function show($catename)
    {
        $cates = Category::all();
        $pages = Page::all();
        $series = Series::all();
        $thiscate = Category::where('catename', $catename)->first()->id;
        $cateinfo = Category::where('catename', $catename)->first();
        $posts = Post::where('category_id', $thiscate)->paginate(10);

        return view('category')->with(compact('cates', 'pages', 'series', 'posts', 'cateinfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //SHOW EDIT PAGE
    public function edit($id)
    {
        $certainCate = Category::where('id', $id)->first();

        return view('cp/categories/cp_addcategory')->with(compact('certainCate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //UPDATE CATEGORY
    public function update(Request $request, $id)
    {
        $validations = 
        [
            "catename"=>"required",
        ];


        $validationMSG= 
        [
            "catename.required" =>"Category name can't be empty",
        ];

        $this->validate($request, $validations, $validationMSG);

        //CHECK IF THE MODIFIED NAME IS UNIQUE OR USED BEFORE
        
        $catesIncheck = Category::all();
        foreach($catesIncheck as $cateIncheck)
        {
            if($cateIncheck->id != $id)
            {
                if($cateIncheck->catename == $request->catename)
                {
                    session()->flash('err_message', 'Category name ('.$request->catename.') is already in use');
                    return back();
                }
                
            }
        }
        if($request->catename == 'uncategorized')
        {
            session()->flash('err_message', 'Category name is not allowed');
            return back();
        }
        else
        {

            //UPDATE CATEGORY DETAILS
            Category::where('id', $id)->update
            ([
                "catename"=>$request->catename,
                "catedesc"=>$request->catedesc
            ]);

            session()->flash('success_message', 'Category has been modified successfully');
            return redirect(route('cp_categories.index'));
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //DELETE CATEGORY
    public function destroy($id)
    {
        //PREPARE THE CURRENT CATEGORY
        $rmcatename = Category::where('id', $id)->first();
        
        //FIRST CHECK IF THIS CATEGORY IS CALLED 'UNCATEGORIZED' OR NOT
        if(Category::where('id', $id)->get('catename') == 'uncategorized')
        {
            //IF IT'S UNCATEGORIZED -> DELETE ALL DATA AND RETURN BACK.
            Category::where('catename', 'uncategorized')->first()->delete();
            Post::where('category_id', Category::where('catename', 'uncategorized')->first()->id)->delete();
            Series::where('category_id', Category::where('catename', 'uncategorized')->first()->id)->delete();

            session()->flash('success_message', $rmcatename->catename.' category has been removed successfully');
            return back();
        }
        else
        //IF IT'S NOT UNCATEGORIZED?
        {
            //CHECK FIRST IF THIS CATEGORY HAS SERIES OR POSTS OR NOT!
            if(Post::where("category_id", $id)->get() || Series::where("category_id", $id)->get())
            {
                //IF IT HAS SERIES OR POSTS THEN CHECK IF THERE IS A CATEGORY CALLED UNCATEGORIZED
                if(Category::where('catename', 'uncategorized')->first())
                {
                    //IF THERE IS ALREADY UNCATEGORIZED CATEGORY THEN TRANSFER SERIES FROM CURRENT CATEGORY TO IT
                    $uncate = Category::where('catename', 'uncategorized')->first()->id;

                    Post::where("category_id", $id)->update([

                        "category_id" =>  $uncate
                        
                    ]);
                    Series::where("category_id", $id)->update([
    
                        "category_id" =>  $uncate
                        
                    ]);
                }
                //IF THERE IS NO UNCATEGORIZED, THEN WE HAVE TO CREATE IT AND TRANSFER DATA TO IT.
                else
                {
                    Category::create([
                        "catename" =>  "uncategorized",
                        "catedesc" => "This category contains all posts which have no manually created category and others",
                    ]); 

                    $uncate = Category::where('catename', 'uncategorized')->first()->id;
                    Post::where("category_id", $id)->update([

                        "category_id" =>  $uncate
                        
                    ]);
                    Series::where("category_id", $id)->update([
    
                        "category_id" =>  $uncate
                        
                    ]);
                }

            }

            //THEN FINALLY DELETE THIS CATEGORY
            Category::where('id', $id)->delete();

            //THEN BACK :D
            session()->flash('success_message', $rmcatename->catename.' category has been removed successfully');
            return back();
        }
        
    }
}
