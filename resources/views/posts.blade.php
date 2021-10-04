<x-layout>
    @foreach ($posts as $post)
    <article>
        <a href="/posts/{{ $post->slug}}">
        <h1>{{ $post->title }}</h1>
        </a>
        <div class="">
            {{ $post->excerpt }}
        </div>
    </article>
    @endforeach
</x-layout>


