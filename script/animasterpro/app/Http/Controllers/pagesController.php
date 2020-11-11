<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Page;
use App\Category;
use App\Series;
use Paginate;

class pagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        Session::put('page','pages');
        $pageList = Page::paginate(10);
        $allpages = Page::orderBy('pagesorder', 'asc')->get();

        if(count($pageList) == 0)
        {
            $emptypage = "0";
            return view('cp/pages/cp_pages')->with(compact(['pageList', 'allpages', 'emptypage']));
        }
        else
        {
            return view('cp/pages/cp_pages')->with(compact('pageList', 'allpages')); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page','pages');

        return view('cp/pages/cp_addpage');
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
            "pagename"=>"required|unique:pages",
            "pagecontent"=>"required"
        ];


        $validationMSG = 
        [
            "pagename.required" =>"Page title can't be empty",
            "pagename.unique" =>"Page title is already used",
            "pagecontent.required" =>"Content can't be empty"
        ];


        $this->validate($request, $validations, $validationMSG);

        $lastPageorder = Page::orderBy('pagesorder', 'desc')->take(1)->get();
        
        $thisorder = $lastPageorder[0]['pagesorder'] + 1;

        Page::create(
        [
            "pagename"=> $request->pagename,
            "pagecontent"=> $request->pagecontent,
            "pagesorder"=> $thisorder
        ]);


        session()->flash('success_message', 'Page has been created successfully');
        return redirect(route('cp_pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pagename)
    {
        $cates = Category::all();
        $pages = Page::all();
        $series = Series::all();
        $thispage = Page::where('pagename', $pagename)->first();

        return view('page')->with(compact('cates', 'pages', 'series', 'thispage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('page','pages');
        
        $certainPage = Page::where('id', $id)->first();

        return view('cp/pages/cp_addpage')->with(compact('certainPage'));
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
            "pagename"=>"required",
            "pagecontent"=>"required"
        ];


        $validationMSG = 
        [
            "pagename.required" =>"Page title can't be empty",
            "pagecontent.required" =>"Content can't be empty"
        ];


        $this->validate($request, $validations, $validationMSG);

        $page = Page::where('pagename', $request->pagename)->get();

        if(count($page) >= 1)
        {
            if($id == $page[0]->id)
            {
                Page::where('id', $id)->update(
                [
                        "pagename"=> $request->pagename,
                        "pagecontent"=> $request->pagecontent,
                ]);
        
                session()->flash('success_message', 'Page has been modified successfully');
                return redirect(route('cp_pages.index'));
            }
            else
            {
                session()->flash('err_message', 'Page title is already used');
                return back();
            }
        }
        else
        {

            Page::where('id', $id)->update(
                [
                    "pagename"=> $request->pagename,
                    "pagecontent"=> $request->pagecontent,
                ]);
        
    
            session()->flash('success_message', 'Page has been modified successfully');
            return redirect(route('cp_pages.index'));
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
        Page::where('id', $id)->delete();

        $pages = Page::orderBy('pagesorder', 'asc')->get();

        foreach($pages as $key => $page)
        {
            Page::where('pagename', $page->pagename)->update([

                "pagesorder" => $key
            ]);

        }


        session()->flash('success_message', 'Page has been deleted successfully');
        return redirect(route('cp_pages.index'));
    }

    public function savearrange(Request $request)
    {
        $pagesorder = $request->pagesorder;

        for($i= 0; $i<count($pagesorder); $i++)
        {
            Page::where('pagename', $pagesorder[$i])->update([

                "pagesorder" => $i
            ]);
        }

        return "Saved Successfully";
    }
}
