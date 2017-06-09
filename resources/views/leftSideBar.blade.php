<div id="sidebar-wrapper">
    <nav id="spy">
        <ul class="sidebar-nav nav">
            <li>
                <h3><a href="/home">Home</a></h3>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">Categories<span class="caret"></span> <b>{{$categories_count}}</b>
                </a>
                <div class="collapse" id="toggleDemo" style="height: 0px;">
                    <ul class="nav nav-list">
                        <li><a href="/category/create">Add Category</a></li>
                        <li><a href="/category/{{Auth::user()->id}}">View My Categories</a></li>
                        <li><a href="/category">View All Categories</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#toggleDemo1" data-parent="#sidenav01" class="collapsed">Posts<span class="caret"></span> <b>{{$posts_count}}</b>
                </a>
                <div class="collapse" id="toggleDemo1" style="height: 0px;">
                    <ul class="nav nav-list">
                        <li><a href="/post/create">Add Post</a></li>
                        <li><a href="/post/{{Auth::user()->id}}">View My Posts</a></li>
                        <li><a href="/post">View All Posts</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#" data-scroll="">
                    <span class="fa fa-anchor solo">Users  <b>{{$users_count}}</b></span>
                </a>
            </li>
        </ul>
    </nav>
</div>
