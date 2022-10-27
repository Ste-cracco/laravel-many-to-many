@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    @if ($post->cover)
        <div class="col-12">
          <img src="{{ asset('storage/'.$post->cover) }}" width="400px" alt="">
        </div>
    @endif
    <div class="col-8">
      <h1>{{ $post->title }}</h1>

      <p>{{ $post->slug }}</p>
      <span> Categoria: {{ $post->category ? $post->category->name : 'nessuna categoria' }} </span> 

      <p>
        <ul>
          @foreach ($post->tags as $tag)
              <li>{{ $tag->name }}</li>
          @endforeach
        </ul>
      </p>

      <ul class="gap-2">
        <li> Post creato in data: {{ $post->created_at }}</li>
        <li>Post aggiornato in data: {{ $post->updated_at }}</li>
      </ul>
    </div>

    <div class="col-4 text-left d-flex justify-content-end align-items-center">
      <a href="{{ route('admin.post.edit',$post) }}" type="button" class="btn btn-primary btn-sm">Modifica</a>
      <form action="{{ route('admin.post.destroy',$post) }}" method="POST">
      
        @csrf
        @method('DELETE')

        <input type="submit" value="Elimina" class="btn btn-danger btn-sm">
      </form>
    </div>
  </div> <!-- Fine Row -->
</div> <!-- Chiusura Container -->

<div class="container">
  <div class="row">
    <div class="col-12">
      <p>
        {!! $post->content !!}
      </p>
    </div>
  </div>
</div>

@endsection