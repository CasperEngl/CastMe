@extends('layouts.master')
@section('content')
<main class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      
      <div class="card">
        <div class="card-header">
          <h4>{{ title_case($post->title) }}</h4>
        </div>
        <figure class="card-img-top">
          <img src="{{ asset('img/hero.jpg') }}" alt="Card image cap">
        </figure>
        <div class="card-body">
          @if (Auth::user()->id === $post->user_id)
            <h5 class="text-muted">{{ ucfirst(__('written by')) }} {{ strtoupper(__('you')) }}</h5>
          @else
            <h5 class="text-muted">{{ ucfirst(__('written by')) }} {{ $post->owner->name }}</h5>
          @endif

          <div class="my-4">
            {!! $post->content !!}
          </div>

          @if (json_decode($post->images)[0] !== null)
            <h6 class="text-muted">{{ title_case(__('images')) }}</h6>
            @foreach (json_decode($post->images) as $image)
            <a href="{{ $image }}" class="image-link" target="_blank">{{ preg_replace('/https|http|(:\/\/)|www\.|\/([^\/]*).*$/', '', $image) }}</a>
            @endforeach
          @endif
        </div>
        @if (Auth::user()->id === $post->user_id)
        <div class="card-footer">
          <div class="row">
            <div class="col-auto ml-auto">
              <a href="/post/{{ $post->id }}/edit" class="card-link btn btn-success">{{ title_case(__('edit')) }}</a>
            </div>
          </div>
        </div>
        @endif
      </div>

      @if ($owner)
        @if (count($comments) > 0)
          <h2 class="page-header mb-0">{{ title_case(__('comments')) }}</h2>
          @foreach ($comments as $comment)
            {{-- Output comment if user is post owner or user own comment --}}
            @if ($owner || Auth::id() === $comment->user_id)
            <div class="card my-3">
              {{ Auth::id() === $comment->owner }}
              <div class="card-header">{{ $comment->owner->name }} {{ $comment->owner->last_name }}</div>
              <div class="card-body">
                {{ strip_tags($comment->content) }}
              </div>
              <div class="card-footer">
                <div class="row align-items-center">
                  <div class="col">{{ Carbon::parse($comment->updated_at)->format('M j \a\t G:i') }}</div>
                  <div class="col-auto">
                    <form action="{{ route('conversation.new') }}" method="POST">
                      <button class="btn btn-primary" type="submit">{{ ucfirst(__('message')) }}</button>

                      {{ Form::hidden('user', Crypt::encrypt($comment->owner->id)) }}
                      @csrf
                      @method('POST')
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @endif
          @endforeach
        {{-- If no comments are found --}}
        @else
        <h2 class="page-header mb-0">{{ title_case(__('No comments')) }}</h2>
        @endif
      @endif
      @if (!$owner)
      <form action="{{ route('comment.new') }}" method="POST">
        <h2 class="page-header mb-0">{{ ucfirst(__('comment')) }}</h2>
        <textarea name="content" class="tinymce"></textarea>
        <button class="btn btn-primary" type="submit">{{ title_case(__('message')) }}</button>

        {{ Form::hidden('post', Crypt::encrypt($post->id)) }}
        @csrf
        @method('POST')
      </form>
      @endif

    </div>
  </div>
</main>
@endsection