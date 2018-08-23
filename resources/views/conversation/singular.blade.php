@extends('layouts.master')
@section('content')
  <main class="container">
    {{--<div>--}}
      {{--{{ dump($messages) }}--}}
    {{--</div>--}}
    <h2 class="page-header">{{ title_case(__('conversation')) }}</h2>

    @if($messages->count() > 0)
      <div class="card">
        @foreach($messages as $message)
          <div class="card-header">
            @if($message->sender->id === Auth::id())
              {{ __('You') }}
            @else
              {{ $message->sender->name }}
            @endif
          </div>
          <div class="card-block">
            <p>
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem cum assumenda quos nihil nulla
              ipsam in et aut quaerat, atque maiores aperiam voluptate voluptatum esse distinctio ea doloribus veniam
              nesciunt error beatae suscipit rem ratione officia minima. Itaque repellat sit atque eum! Error quisquam
              consequuntur minima commodi, eaque fugit sequi.
            </p>
          </div>
          @endforeach
      </div>
    @else
      <p>No messages send yet //TODO: Replace with appropriate info message</p>
    @endif

    <form action="{{ $form_url }}" method="POST">
      <textarea name="content" class="tinymce"></textarea>
      <button type="submit" class="btn btn-primary">{{ title_case(__('send')) }}</button>

      @csrf
      @method('POST')
    </form>

  </main>
@endsection