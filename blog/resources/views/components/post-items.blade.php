<ul>
    @foreach($posts as $post)

    <x-post-item :post="$post" />
    <!-- <li>
                <div>
                    <h2><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h2>
                    <div>{{$post->excerpt}}</div> <br>

                    <x-post-meta :post="$post" /> 
                    <div>{{$post->date->diffForHumans() }} by <a href="/authors/{{$post->author}}">{{$post->author_name}}</a> </div> 
                    <div></div>
                </div>
            </li> -->
    @endforeach
</ul>