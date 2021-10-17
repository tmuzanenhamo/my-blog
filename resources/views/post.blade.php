<x-layout>
    <article>
        <h1>{{ $post->title }}</h1>

        <div class="">
            <p>
                <a href="/categories/{{$post->category->slug}}">{{ $post->category->name}}</a>
            </p>
        </div>

        <div>
            <p>
            {!! $post->body !!}
            </p>
        </div>
    </article>
    <a href="/">Go Back</a>
</x-layout>


