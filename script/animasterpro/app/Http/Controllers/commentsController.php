<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;
use App\Admin;
use Auth;
use Session;

use Paginate;

class commentsController extends Controller
{
    //SAVE COMMENTS OF USERS
    public function saveComment(Request $request, $userid, $postid)
    {
        //VALIDATE COMMENT
        $validations=[

            "memcomment"=>"regex:regex:/(^[A-Za-z0-9 ]+$)+/",

        ];
        $validationMSG = [
            "memcomment.regex" => "Only numbers, letters and spaces are allowed",
        ];

        $this->validate($request, $validations, $validationMSG);

        //CHECKING USER ID
        if (!filter_var($userid, FILTER_VALIDATE_INT)) 
        {
            session()->flash('err_message', 'An error has been occured');
            return back();
        } 
        else 
        {
            //CHECKING POST ID
            if (!filter_var($postid, FILTER_VALIDATE_INT)) 
            {
                session()->flash('err_message', 'An error has been occured');
                return back();
            } 
            else
            {
                //SANITIZE USER AND POST ID
                $checkeduserid = filter_var($userid, FILTER_SANITIZE_NUMBER_INT);
                $checkedpostid = filter_var($postid, FILTER_SANITIZE_NUMBER_INT);

                if(Auth::guard('admin')->check())
                {   
                    Comment::create([
                        "post_id"=>$checkedpostid,
                        "user_id"=>$checkeduserid,
                        "value"=>$request->memcomment,
                        "role"=>'admin',
                    ]);
                    
                }
                else
                {
                    Comment::create([
                        "post_id"=>$checkedpostid,
                        "user_id"=>$checkeduserid,
                        "value"=>$request->memcomment,
                    ]);
                }

                session()->flash('success_message', 'Your comment has been added successfully');
                return back();

            }
        }
    }

    //SHOW COMMENTS INDEX PAGE
    public function index()
    {
        Session::put('page', 'comment');
        $comments = Comment::paginate(10);

        if(count($comments) == 0)
        {
            $emptycom = '';
            return view('cp/comments/comments')->with(compact('comments', 'emptycom'));
        }
        else
        {
            $comments = Comment::paginate(10);
            return view('cp/comments/comments')->with(compact('comments'));
        }

    }

    //SEARCH COMMENTS
    public function searchcomment(Request $request)
    {
        $input = $request->input;
        $option = $request->option;

        $arr = Comment::where($option, 'LIKE', '%'.$input.'%')->get();

        if(count($arr)==0)
        {
            return '';
        }
        else
        {
            $counter = 0;

            //RETURN VALUES OF SEARCH IN A CUSTOM ARRAY
            foreach ($arr as $obj)
            {
    
                $fin[$counter][0] =  $obj->id;
                $fin[$counter][1] =  $obj->post_id;
                $fin[$counter][2] =  $obj-> Post::where('id', $obj->post_id)->first()->title;
                $fin[$counter][3] =  $obj->user_id;
                if($obj->role=="admin")
                {
                    $fin[$counter][4] =  Admin::where('id', 1)->first()->name;
                }
                else
                {
                    $fin[$counter][4] =  $obj-> User::where('id', $obj->user_id)->first()->name;
                }
                $fin[$counter][5] =  $obj->value;
    
                $counter++;
            }  
    
            return $fin;

        }
    }

    //SHOW A CERTAIN COMMENT INFO
    public function show($id)
    {
        $certaincom = Comment::where('id', $id)->first();

        return view('cp.comments.viewcomment')->with(compact('certaincom'));
    }

    //DELETE COMMENT
    public function destroy($id)
    {
        Comment::where('id', $id)->delete();
        
        session()->flash('success_message', 'Comment has been deleted successfully');

        return redirect(route('cp_comment.index'));
    }

}
