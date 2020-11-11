$(document).ready(function()
{

// CSRF Preparation
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Check Current Password - Update Informatio
$('#current_em_password').on('keyup', function()
{
    $.ajax(
        {
        type:'post',
        url: '/cp_chk_pwd',
        data: {current_pwd: $('#current_em_password').val()},
        success:function(resp)
        {
            if(resp =='true')
            {
                $('#current_em_password').css('border-color', 'MediumSeaGreen')
            }
            else
            {
                $('#current_em_password').css('border-color', 'tomato')
            }

        },error:function()
        {
            alert('Error');
        }

    });
});
//Check Current Password - Update Password
$('#oldpassword').on('keyup', function()
{
    $.ajax(
        {
        type:'post',
        url: '/cp_chk_pwd_ch',
        data: {current_pwd: $('#oldpassword').val()},
        success:function(resp)
        {
            if(resp =='true')
            {
                $('#oldpassword').css('border-color', 'MediumSeaGreen');
            }
            else
            {
                $('#oldpassword').css('border-color', 'tomato');
            }

        },error:function()
        {
            alert('Error');
        }

    });

});

$('#removeAdminImage').on('click', function()
{
    $.ajax(
        {
        type:'post',
        url: '/cp_profimage_rm',
        success:function(resp)
        {
            if(resp =='true')
            {
                location.reload();
            }
            else
            {
                $('#oldpassword').css('border-color', 'tomato');
            }

        },error:function()
        {
            alert('Error');
        }

    });

});


//Remove video btn from Text Editor
    $('.note-icon-video').parent().remove();


//Image upload way choose
$('#choose_img-btn-1').on('click', function(){

    $('.image-link input').val('');
    $('.image-link').removeClass('sop').fadeOut(1);
    $('.upload-image').fadeIn(300).addClass('sop');

});

$('#choose_img-btn-2').on('click', function()
{

    $('.upload-image input').val('');
    $('.upload-image').removeClass('sop').fadeOut(1);
    $('.image-link').fadeIn(300).addClass('sop');

});


    //Sidebar submenu show
    $('.components li a').on('click', function(){

        var requestedele = $(this).data('class');

        $('#'+requestedele).slideToggle();
    })

    // Unify the length of sidebar and viewer
    var winwidth= window.innerWidth
    var viewerheight = $("#viewer").height();
    var sideheight = $("#sidebar").height();

    if(winwidth > 991)
    {
        if(viewerheight > sideheight)
        {
            $('#sidebar').css("height", viewerheight +"px");
        }
        else if(viewerheight < sideheight)
        {
            $('#viewer').css("height", sideheight +"px");
        }

    }

    //Sidebar slider
    $(".sidebar-slider .showsidediv").on("click", function(){

        $(".sidediv").slideToggle();
    })

    
        //Delete category
        $(".del-category").click(function(e)
        {
            e.preventDefault();
    
            var linkdel = $(this).data("class");
    
            $(".messageconfirm").fadeIn();
    
            $(".cat-del-action").click(function(e)
            {
                e.preventDefault();
    
                window.location.href = linkdel;
    
            })
        });

        //Delete Series
        $(".del-series").click(function(e)
        {
            e.preventDefault();
    
            var linkdel = $(this).data("class");

            $('.quiz p').html('Do you want to delete this series?')
    
            $(".messageconfirm").fadeIn();
    
            $(".cat-del-action").click(function(e)
            {
                e.preventDefault();
    
                window.location.href = linkdel;
    
            })
        });

        //Delete Page
        $(".page_delete").click(function(e)
        {
            e.preventDefault();
    
            var linkdel = $(this).data("class");

            $('.quiz p').html('Do you want to delete this Page?')
    
            $(".messageconfirm").fadeIn();
    
            $(".cat-del-action").click(function(e)
            {
                e.preventDefault();
    
                window.location.href = linkdel;
    
            })
        });
        
        //Delete Post
        $(".post_delete").click(function(e)
        {
            e.preventDefault();
    
            var linkdel = $(this).data("class");

            $('.quiz p').html('Do you want to delete this Post?')
    
            $(".messageconfirm").fadeIn();
    
            $(".cat-del-action").click(function(e)
            {
                e.preventDefault();
    
                window.location.href = linkdel;
    
            })
        });
        

        //Summernotes
        $("#postcontent").summernote();
        /*$("#seriesinfo").summernote();
        $("#sercontent").summernote();*/
        $(".pagecontent").summernote();
        $("#adminreply").summernote();

        //Show series type
        $('#selectvidtype').on('change', function(){

            if($('#selectvidtype').val() === 'Yes')
            {
                $('.existser').fadeIn(300);
            }
            else
            {
                $('.existser').fadeOut(1);
            }
    
        });
        //Add/Remove Host Servers
        $('.addvidlink').click(function(){

            $('.vid-gather').append('<div class="fullinput"><div class="del_input"><input type="text" name="servername[]"class="form-control-file" id="postvidlink" placeholder="Server name"><a class="btn btn-sm btn-primary rmvidlink"><i class="fas fa-minus text-white"></i></a></div><textarea name="vidcode[]" class="form-control" rows="5" id="comment" placeholder="code"></textarea></div>');
    
        });
    
        $(document).on('click', '.rmvidlink',function(){
            if($(this).parents('div').eq(2).children().length > 1)
            {
                $(this).parents('div').eq(1).remove();
            }
    
        });

        //Add/Remove Download Options
        $('.addvidlinkdw').click(function(){

            $('.vid-gather-links').append('<div class="vid-fullinput"><div class="servname"><input type="text" placeholder="Server name" class="form-control" name="servnameval[]"><a class="btn btn-sm btn-primary rmvidlinkdw"><i class="fas fa-minus text-white"></i></a></div><div class="serlink"><div class="icon-link"><i class="fas fa-link"></i></div><input type="url" name="postvidlinkdwname[]" class="form-control-file" id="postvidlinkdw" placeholder="Download link"></div></div>');
    
        });
    
        $(document).on('click', '.rmvidlinkdw',function(){
    
            if($(this).parents('div').eq(2).children().length > 1)
            {
                $(this).parents('div').eq(1).remove();
            }
    
        });

        //Select Category when series is chosen 
        $('#selectseries').on('change', function()
        {

            if($('#selectseries').val() != '')
            {
                $.ajax({

                    type:'get',
                    url: '/getseriescategory',
                    data: {selectedser: $('#selectseries').val()},
                    success:function(resp)
                    {
                        $('#catelist').html('');
                        $('#catelist').append('<option selected>'+resp+'</option>');
            
                    },error:function(resp)
                    {
                        console.log(resp.responseText);
                    }
            
                });
            }
            else
            {
                $.ajax({

                    type:'get',
                    url: '/getseriescategory',
                    data: {selectedser: $('#selectseries').val()},
                    success:function(resp)
                    {
                        $('#catelist').html('');
                        var arr = resp.split(' ');

                        for(var i=0; i<arr.length; i++)
                        {
                            $('#catelist').append('<option selected>'+arr[i]+'</option>');
                        
                        }

                    },error:function(resp)
                    {
                        console.log(resp.responseText);
                    }
            
                });
            }


        });

        $('#selectvidtype').on('change', function()
        {

            if($('#selectvidtype').val() == 'No')
            {

                $.ajax({

                    type:'get',
                    url: '/getseriescategory',
                    data: {selectedser: $('#selectseries').val()},
                    success:function(resp)
                    {
                        $('#catelist').html('');
                        var arr = resp.split(' ');

                        for(var i=0; i<arr.length; i++)
                        {
                            $('#catelist').append('<option selected>'+arr[i]+'</option>');
                        
                        }

                    },error:function(resp)
                    {
                        console.log(resp.responseText);
                    }
            
                });

             }
        });
        //Show send post loading background
        $('.subton').on('click', function(){

            $('.sendpostloding').css("display", "flex");

        });

        //Disable "Enter" button submit
        $(document).on("keypress", 'form', function (e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                e.preventDefault();
                return false;
            }
        });
        //Remove card border when there is no categories 
        if($('catemsg'))
        {
            $('.bordcard').css("border", "0px");
        }

        //Member Search
        $('.memsearch').on('click', function(e)
        {
            e.preventDefault();

            var input = $('#memsearchinput').val();
            var option = $('#searchopt').val();

            if(input == '')
            {
                $('#memsearchinput').css('border-color', 'tomato');
            }
            else
            {
                $.ajax({

                    type:'post',
                    url:'/cp_searchMember',
                    data:
                    {
                        input:input,
                        option:option
                    },
                    success:function(data)
                    {
                        $('.pagination').hide();
                        $('.noCates').remove();
                        $('.memberList').html('');

                        if(data.length>=1)
                        {
                            console.log(data);

                            for(var i=0; i<data.length; i++)
                            {
                                document.getElementById('memberList').innerHTML += '<tr><td>'+(i+1)+'</td><td>'+data[i]["name"]+'</td><td>'+data[i]["email"]+'</td><td>'+(data[i]["block"] == null ? "Normal" : "Blocked")+'</td><td><div class="row catetable" style="justify-content:space-between;"><a href="#"><i class="fas fa-eye"></i></i></a><a href="/cp_managemem/'+data[i]['id']+'/edit"><i class="far fa-edit text-primary"></i></a><a href="/cp_managemem/'+data[i]['id']+'/del"><i class="fas fa-trash-alt text-danger"></i></a></div></td></tr>';
                            }

                        }
                        else
                        {
  
                            document.getElementById('view-table').innerHTML += '<h6 class="noCates">No data found<h6>';
                            
                        }

                    },
                    error:function(data)
                    {   
                        console.log(data.responseText);
                    }

                });
            }

        });
        
        //Show Blocked members only
        $('#showblkmem').on('click', function(e)
        {
            e.preventDefault();

            console.log('horar');

            var option = 'block';

            $.ajax({
                type:'post',
                url:'/cp_searchMember',
                data:
                {
                    option:option
                },
                success:function(data)
                {
                    $('.pagination').hide();
                    $('.noCates').remove();
                    $('.memberList').html('');

                    if(data.length>=1)
                    {
                        console.log(data);

                        for(var i=0; i<data.length; i++)
                        {
                            document.getElementById('memberList').innerHTML += '<tr><td>'+(i+1)+'</td><td>'+data[i]["name"]+'</td><td>'+data[i]["email"]+'</td><td>'+(data[i]["block"] == null ? "Normal" : "Blocked") +'</td><td><div class="row catetable" style="justify-content:space-between;"><a href="#"><i class="fas fa-eye"></i></i></a><a href="/cp_managemem/'+data[i]['id']+'/edit"><i class="far fa-edit text-primary"></i></a><a href="/cp_managemem/'+data[i]['id']+'/del"><i class="fas fa-trash-alt text-danger"></i></a></div></td></tr>';
                        }

                    }
                    else
                    {

                        document.getElementById('view-table').innerHTML += '<h6 class="noCates">No data found<h6>';
                        
                    }

                },
                error:function(data)
                {   
                    console.log(data.responseText);
                }

            });
        
        });

        //Show block IP input
        $('.blockipdatafieldbtn').on('click', function()
        {
            $('.blockdatadiv input').val('');
            $('.blockdatadiv').slideUp(1);
            $('.blockdatabyipdiv').slideDown();

        })

    //Show reply sender message
    $('#replymessage').on('click', function(e)
    {
        e.preventDefault();

        $(this).parent('.under_form').html('<div class="form-group"><label for="adminreply">Message:</label><textarea name="adminreply" id="adminreply" cols="30" rows="3" class="form-control"></textarea></div><button class="btn btn-primary btn-lg" id="sendadminmsg">Send</button><div class="messageshape img-thumbnail p-5"><p>Thanks for your message</p><div class="messagecont" id="messagecont"></div><div>Thanks,<br><I>Sitename</I></div></div>');


    });

    //Export Message content to view
    $(document).on('keyup', '#adminreply', function(){

        document.getElementById('messagecont').textContent = $("#adminreply").val();

    });

    //Comment Search
    $('.comsearch').on('click', function(e)
    {
        e.preventDefault();

        var input = $('#comsearchinput').val();
        var option = $('#comsearchopt').val();

        if(input == '')
        {
            $('#comsearchinput').css('border-color', 'tomato');
        }
        else
        {
            $.ajax({

                type:'POST',
                url:'/cp_searchcomment',
                data:
                {
                    input:input,
                    option:option
                },
                success:function(data)
                {
                    $('.pagination').hide();
                    $('.noCates').remove();
                    $('.memberList').html('');

                    if(data.length>=1)
                    {
                        console.log(data[0]);
                        
                        if(data.length == 1)
                        {
                            
                            for(var i=0; i<data.length; i++)
                            {
                                document.getElementById('memberList').innerHTML += '<tr><td>'+(i+1)+'</td><td>'+data[i][2]+'</td><td>'+data[i][1]+'</td><td>'+data[i][4]+'</td><td>'+data[i][3]+'</td><td><div class="row catetable" style="justify-content:space-between;"><a href="/cp_comment/'+data[i][0]+'/show"><i class="fas fa-eye"></i></a><a href="/cp_comment/'+data[i][0]+'/del"><i class="fas fa-trash-alt text-danger"></i></a></div></td></tr>';
                            }
                        }
                        else
                        {
                            for(var i=0; i<data.length; i++)
                            {
                                document.getElementById('memberList').innerHTML += '<tr><td>'+(i+1)+'</td><td>'+data[i][2]+'</td><td>'+data[i][1]+'</td><td>'+data[i][4]+'</td><td>'+data[i][3]+'</td><td><div class="row catetable" style="justify-content:space-between;"><a href="/cp_comment/'+data[i][0]+'/show"><i class="fas fa-eye"></i></a><a href="/cp_comment/'+data[i][0]+'/del"><i class="fas fa-trash-alt text-danger"></i></a></div></td></tr>';
                            }
                        }
                        
                    }
                    else
                    {

                        document.getElementById('view-table').innerHTML += '<h6 class="noCates">No data found<h6>';
                        
                    }

                },
                error:function(data)
                {   
                    console.log(data.responseText);
                }

            });
        }

    });

//Show Facebook comment code enter fields
$('#activefacebook').on('change', function(){

    if($('#activefacebook').val() === 'Yes')
    {
        $('.faceinfo').slideDown(300);
    }
    else
    {
        $('.faceinfo').slideUp(200);
    }
})

if($('#activefacebook').val() === 'Yes')
{
    $('.faceinfo').fadeIn(1);
}

//Drag Pages (Arrangement)

//Local

    $(".draggable").on('dragstart', function()
    {
        draggable.addClass('dragging');

    });

    $(".draggable").on('dragend', function()
    {

        draggable.removeClass('dragging');

    });

/// Imported Function
(function( name, factory ) {
   
    if( typeof window === "object" ) {
       
       // add to window 
       window[ name ] = factory();
       
       // add jquery plugin, if available  
       if( typeof jQuery === "object" ) {
          jQuery.fn[ name ] = function( options ) {
             return this.each( function() {
                new window[ name ]( this, options );
             });
          };
       }
    }
     
 })( "Sortable", function() {
    
    var _w = window,
        _b = document.body,
        _d = document.documentElement;
    
    // get position of mouse/touch in relation to viewport 
    var getPoint = function( e )
    {
       var scrollX = Math.max( 0, _w.pageXOffset || _d.scrollLeft || _b.scrollLeft || 0 ) - ( _d.clientLeft || 0 ), 
           scrollY = Math.max( 0, _w.pageYOffset || _d.scrollTop || _b.scrollTop || 0 ) - ( _d.clientTop || 0 ), 
           pointX  = e ? ( Math.max( 0, e.pageX || e.clientX || 0 ) - scrollX ) : 0,
           pointY  = e ? ( Math.max( 0, e.pageY || e.clientY || 0 ) - scrollY ) : 0; 
       
       return { x: pointX, y: pointY }; 
    }; 
    
    // class constructor
    var Factory = function( container, options )
    {
       if( container && container instanceof Element )
       {
          this._container = container; 
          this._options   = options || {}; /* nothing atm */
          this._clickItem = null;
          this._dragItem  = null;
          this._hovItem   = null;
          this._sortLists = [];
          this._click     = {};
          this._dragging  = false;
          
          this._container.setAttribute( "data-is-sortable", 1 );
          this._container.style["position"] = "static";
          
          window.addEventListener( "mousedown", this._onPress.bind( this ), true );
          window.addEventListener( "touchstart", this._onPress.bind( this ), true );
          window.addEventListener( "mouseup", this._onRelease.bind( this ), true ); 
          window.addEventListener( "touchend", this._onRelease.bind( this ), true ); 
          window.addEventListener( "mousemove", this._onMove.bind( this ), true );
          window.addEventListener( "touchmove", this._onMove.bind( this ), true );
       }
    };
    
    // class prototype
    Factory.prototype = {
       constructor: Factory,
       
       // serialize order into array list 
       toArray: function( attr )
       {
          attr = attr || "id";
          
          var data = [], 
              item = null, 
              uniq = ""; 
          
          for( var i = 0; i < this._container.children.length; ++i )
          {
             item = this._container.children[ i ], 
             uniq = item.getAttribute( attr ) || "";
             uniq = uniq.replace( /[^0-9]+/gi, "" );
             data.push( uniq );
          }
          return data;
       }, 
       
       // serialize order array into a string 
       toString: function( attr, delimiter )
       {
          delimiter = delimiter || ":"; 
          return this.toArray( attr ).join( delimiter );
       }, 
       
       // checks if mouse x/y is on top of an item 
       _isOnTop: function( item, x, y )
       {
          var box = item.getBoundingClientRect(),
              isx = ( x > box.left && x < ( box.left + box.width ) ), 
              isy = ( y > box.top && y < ( box.top + box.height ) ); 
          return ( isx && isy );
       },
       
       // manipulate the className of an item (for browsers that lack classList support)
       _itemClass: function( item, task, cls )
       {
          var list  = item.className.split( /\s+/ ), 
              index = list.indexOf( cls );
          
          if( task === "add" && index == -1 )
          { 
             list.push( cls ); 
             item.className = list.join( " " ); 
          }
          else if( task === "remove" && index != -1 )
          {
             list.splice( index, 1 ); 
             item.className = list.join( " " ); 
          }
       }, 
       
       // swap position of two item in sortable list container 
       _swapItems: function( item1, item2 )
       {
          var parent1 = item1.parentNode, 
              parent2 = item2.parentNode;
          
          if( parent1 !== parent2 ) 
          {
             // move to new list 
             parent2.insertBefore( item1, item2 );
          }
          else { 
             // sort is same list 
             var temp = document.createElement( "div" ); 
             parent1.insertBefore( temp, item1 );
             parent2.insertBefore( item1, item2 );
             parent1.insertBefore( item2, temp );
             parent1.removeChild( temp );
          }
       },
       
       // update item position 
       _moveItem: function( item, x, y )
       {
          item.style["-webkit-transform"] = "translateX( "+ x +"px ) translateY( "+ y +"px )";
          item.style["-moz-transform"] = "translateX( "+ x +"px ) translateY( "+ y +"px )";
          item.style["-ms-transform"] = "translateX( "+ x +"px ) translateY( "+ y +"px )";
          item.style["transform"] = "translateX( "+ x +"px ) translateY( "+ y +"px )";
       },
       
       // make a temp fake item for dragging and add to container 
       _makeDragItem: function( item )
       {
          this._trashDragItem(); 
          this._sortLists = document.querySelectorAll( "[data-is-sortable]" );
          
          this._clickItem = item; 
          this._itemClass( this._clickItem, "add", "active" ); 
 
          this._dragItem = document.createElement( item.tagName );
          this._dragItem.className = "dragging"; 
          this._dragItem.innerHTML = item.innerHTML; 
          this._dragItem.style["position"] = "absolute";
          this._dragItem.style["z-index"] = "999";
          this._dragItem.style["left"] = ( item.offsetLeft || 0 ) + "px";
          this._dragItem.style["top"] = ( item.offsetTop || 0 ) + "px";
          this._dragItem.style["width"] = ( item.offsetWidth || 0 ) + "px";
          
          this._container.appendChild( this._dragItem ); 
       }, 
       
       // remove drag item that was added to container 
       _trashDragItem: function()
       {
          if( this._dragItem && this._clickItem )
          {
             this._itemClass( this._clickItem, "remove", "active" ); 
             this._clickItem = null; 
             
             this._container.removeChild( this._dragItem ); 
             this._dragItem = null; 
          }
       }, 
       
       // on item press/drag 
       _onPress: function( e )
       {
          if( e && e.target && e.target.parentNode === this._container )
          {
             e.preventDefault();
             
             this._dragging = true;
             this._click = getPoint( e ); 
             this._makeDragItem( e.target ); 
             this._onMove( e );
          }
       },
       
       // on item release/drop 
       _onRelease: function( e )
       {
          this._dragging = false;
          this._trashDragItem(); 
       },
       
       // on item drag/move
       _onMove: function( e )
       {
          if( this._dragItem && this._dragging ) 
          {
             e.preventDefault();
             
             var point     = getPoint( e ); 
             var container = this._container;
 
             // drag fake item 
             this._moveItem( this._dragItem, ( point.x - this._click.x ), ( point.y - this._click.y ) ); 
             
             // keep an eye for other sortable lists and switch over to it on hover 
             for( var a = 0; a < this._sortLists.length; ++a )
             {
                var subContainer = this._sortLists[ a ]; 
                
                if( this._isOnTop( subContainer, point.x, point.y ) ) 
                {
                   container = subContainer;
                }
             }
             
             // container is empty, move clicked item over to it on hover 
             if( this._isOnTop( container, point.x, point.y ) && container.children.length === 0 ) 
             {
                container.appendChild( this._clickItem ); 
                return; 
             }
             
             // check if current drag item is over another item and swap places 
             for( var b = 0; b < container.children.length; ++b )
             {
                var subItem = container.children[ b ]; 
                
                if( subItem === this._clickItem || subItem === this._dragItem )
                {
                   continue; 
                }
                if( this._isOnTop( subItem, point.x, point.y ) ) 
                {
                   this._hovItem = subItem; 
                   this._swapItems( this._clickItem, subItem ); 
                }
             }
          }
       },
       
    };
 
    // export
    return Factory;
 });
 
 
 // helper init function 
 function initSortable( list, sbtn )
 {
    var listObj  = document.getElementById( list ),
        sbtnObj  = document.getElementById( sbtn ),
        sortable = new Sortable( listObj ); 
    
 }
 
 // init lists 
 initSortable( "list-1", "sbtn-1" );
 initSortable( "list-2", "sbtn-2" );

//Send Page Arrangement
$("#savepagearrange").on('click', function()
{
    

    var pagesorder = [];
    
    for(var i=1; i<=$('.pagessortlist li').length; i++)
    {
        pagesorder.push($( ".pagessortlist li:nth-child("+i+")").html());
    }

    $.ajax({

        type: 'post',
        url: '/cp_savepagesarrange',
        data:
        {
            pagesorder: pagesorder
        },
        success:function(data)
        {
            $('#pageordersuccess').css('display', 'block');
            $('#pageordersuccess').text(data);
        },
        error:function(data)
        {
            console.log(data.responseText);
        }




    });


});



});