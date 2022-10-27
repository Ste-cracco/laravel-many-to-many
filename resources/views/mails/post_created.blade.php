@component('mail::message')
# Nuovo Post

Un nuovo Post è stato creato!
 
@component('mail::button', ['url' => route('admin.post.show', $post)])
{{ $post->title }}
@endcomponent
 
Grazie,<br>
{{ config('app.name') }}
@endcomponent




{{-- Senza Markup
    
    <label for="">Titolo del nuovo Post</label>

<h1>
    <a href="{{ route('admin.post.show', $post) }}"></a>
    {{ $post->title }}
</h1> --}}