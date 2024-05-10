<li>
    <div>
        <h2><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h2>
        <div>{{$post->excerpt}}</div> <br>
        <!-- <div>{{$post->date->diffForHumans() }} by <a href="/authors/{{$post->author}}">{{$post->author_name}}</a> </div> -->
        <x-post-meta :post="$post" />
        <div></div>
    </div>
</li>