<x-layout>
    @foreach ($posts as $post )
        <h1><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h1>
        <div class="">
            <p>
                {{ $post->excerpt}}
            </p>
        </div>
    @endforeach
</x-layout>
