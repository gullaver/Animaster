
  <div class="sidebar-slider">
                    <i class="fas fa-bars showsidediv"></i>
                </div>
                <div class="sidediv col-lg-3 order-0">
                    <nav id="sidebar" class="sidebar">
                        <div class="sidelayer"></div>
                            <div class="container row">
                                

                                <div class="avatarname col-12">
                                    <?php
                                        $adminimage = App\Admin::where('email', Auth::guard('admin')->user()->email)->first()->image;
                                    ?>
                                    @if(isset($adminimage) && $adminimage != '')
                                    <img src="{{url('images/admin_images/admin_photoes/'.$adminimage.'')}}" class="img-thumbnail avatar">
                                    @else
                                    <img src="{{url('images/admin_images/admin_photoes/default.png')}}" class="img-thumbnail avatar">
                                    @endif
                                    <div class="avatarname-body">
                                    <a  class="avatarname-name" href="{{route('admin.getadminsettings')}}" class="d-block"><strong>{{ucwords(Auth::guard('admin')->user()->name)}}</strong></a>
                                    </div>
                                </div>
                            
                                <ul class="list-unstyled components col-12">
                                    <li class="active">
                                        @if(session()->get('page') === 'dashboard')
                                        <a href="{{route('dashboard.index')}}" class="cateactive main_list_item">
                                        <i class="fas fa-tachometer-alt"></i>
                                        Dashboard
                                        </a>
                                        @else
                                        <a href="{{route('dashboard.index')}}" class="main_list_item">
                                        <i class="fas fa-tachometer-alt"></i>
                                        Dashboard
                                        </a>
                                        @endif
                                    </li>
                                    <li>
                                    @if(session()->get('page') === 'cates')
                                        <a href="{{route('cp_categories.index')}}" data-class ="catesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item cateactive">
                                            <i class="fas fa-list-alt"></i>
                                            Categories
                                        </a>
                                    @else
                                        <a href="{{route('cp_categories.index')}}" data-class ="catesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item">
                                            <i class="fas fa-list-alt"></i>
                                            Categories
                                        </a>
                                    @endif
                                        <ul class="collapse list-unstyled" data="catesSubmenu" id="catesSubmenu">
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_categories.create')}}">Add category</a>
                                            </li>
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_categories.index')}}">Categories list</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                    @if(session()->get('page') === 'series')
                                        <a href="{{route('cp_series.index')}}" data-class ="seriesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item cateactive">
                                        <i class="fas fa-tv"></i>
                                            Series
                                        </a>
                                    @else
                                        <a href="{{route('cp_series.index')}}" data-class ="seriesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item">
                                        <i class="fas fa-tv"></i>
                                            Series
                                        </a>
                                    @endif
                                        <ul class="collapse list-unstyled" data="seriesSubmenu" id="seriesSubmenu">
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_series.create')}}">Add series</a>
                                            </li>
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_series.index')}}">Series list</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        @if(session()->get('page') === 'posts')
                                        <a href="#" data-class ="postsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item cateactive">
                                        <i class="fas fa-clone"></i>
                                            Posts
                                        </a>
                                        @else
                                        <a href="#" data-class ="postsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item">
                                        <i class="fas fa-clone"></i>
                                            Posts
                                        </a>
                                        @endif
                                        <ul class="collapse list-unstyled" data="postsSubmenu" id="postsSubmenu">
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_posts.create')}}">Add post</a>
                                            </li>
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_posts.index')}}">Posts list</a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li>
                                        @if(session()->get('page') === 'pages')
                                        <a href="{{route('cp_pages.index')}}" data-class ="pagesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item cateactive">
                                            <i class="fas fa-sticky-note"></i>
                                            Pages
                                        </a>
                                        @else
                                        <a href="{{route('cp_pages.index')}}" data-class ="pagesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item">
                                            <i class="fas fa-sticky-note"></i>
                                            Pages
                                        </a>
                                        @endif
                                        <ul class="collapse list-unstyled" data="pagesSubmenu" id="pagesSubmenu">
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_pages.create')}}">Add Page</a>
                                            </li>
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_pages.index')}}">Pages list</a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li>
                                        @if(session()->get('page') === 'members')
                                        <a href="{{route('cp_managemem.index')}}" data-class ="membersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item cateactive">
                                            <i class="fas fa-users"></i>
                                            Members
                                        </a>
                                        @else
                                        <a href="{{route('cp_managemem.index')}}" data-class ="membersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item">
                                            <i class="fas fa-users"></i>
                                            Members
                                        </a>
                                        @endif
                                        <ul class="collapse list-unstyled" data="membersSubmenu" id="membersSubmenu">
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_managemem.create')}}">Add new member</a>
                                            </li>
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_managemem.index')}}">Manage members</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        @if(session()->get('page') === 'comment')
                                        <a href="{{route('cp_comment.index')}}"  data-class ="commentssSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item cateactive">
                                        <i class="fas fa-comments"></i>
                                            Comments
                                        </a>
                                        @else
                                        <a href="{{route('cp_comment.index')}}"  data-class ="commentssSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item">
                                        <i class="fas fa-comments"></i>
                                            Comments
                                        </a>
                                        @endif
                                        <ul class="collapse list-unstyled" data="commentssSubmenu" id="commentssSubmenu">
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_comment.index')}}">Comments</a>
                                            </li>
                                            <li>
                                                <a class="sub_list_item" href="{{route('comment.settings')}}">Comments settings</a>
                                            </li>
                                        </ul>
                                    <li>
                                        @if(session()->get('page') === 'message')
                                        <a href="{{route('message.show')}}" class="cateactive main_list_item">
                                        <i class="fas fa-envelope"></i>
                                            Messages
                                        </a>
                                        @else
                                        <a href="{{route('message.show')}}" class="main_list_item">
                                        <i class="fas fa-envelope"></i>
                                            Messages
                                        </a>
                                        @endif
                                    </li>
                                    <li>
                                    @if(session()->get('page') === 'settings')
                                        <a href="{{route('cp_ssettings.index')}}" data-class ="settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item cateactive">
                                            <i class="fas fa-cog"></i>
                                            Settings
                                        </a>
                                        @else
                                        <a href="{{route('cp_ssettings.index')}}" data-class ="settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_list_item">
                                            <i class="fas fa-cog"></i>
                                            Settings
                                        </a>
                                        @endif
                                        <ul class="collapse list-unstyled" data="settingsSubmenu" id="settingsSubmenu">
                                            <li>
                                                <a class="sub_list_item" href="{{route('admin.getadminsettings')}}">Admin settings</a>
                                            </li>
                                            <li>
                                                <a class="sub_list_item" href="{{route('cp_ssettings.index')}}">Site settings</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                        </div>
                    </nav>
                </div>