<label for="">Titolo del nuovo Post</label>

<h1>
    <a href="{{ route('admin.post.show', $post) }}"></a>
    {{ $post->title }}
</h1>