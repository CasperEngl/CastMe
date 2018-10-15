@extends('layouts.master')
@section('content')
<div class="container content-wrapper">
   <div class="row d-flex align-items-center">
      <div class="col">
         <h1>{{ title_case(__('contact information')) }}</h1>
         Cast Me IVS <br>
         Cvr. 39302845 <br>
         Carl bernhardsvej 13B <br>
         Frederiksberg 1817 <br>
         Tlf: +45 31171877 <br>
         Mail: support@castme.dk <br>
         <h2>{{ title_case(__('when can you contact us?')) }}</h2>
         <p>Du kan altid kontakte os hvis du har nogle spørgsmål til vores platform, oprettelser eller hvis du ønsker at blive scout. For at holde vores tilknyttede virksomheder reelle og autoriserede, kan man derfor heller ikke oprette sin egen scout profil.
            Dette bedes du ansøge om på dette link: (Link).
            <br>
            <br>
            Vi opfordrer til at man også kontakter os, hvis man skulle være så uheldig at have en dårlig oplevelse med enten vores oprettede brugere, eller vores tilknyttede virksomheder (Scout profiler).<br>
            Det er os en utrolig vigtig faktor, at der bliver slået hårdt ned på misbrug, chikane og andre former for uacceptabel brug af Castme platformen.<br>
            <br>
            Føler du dig nogensinde dårlig behandlet af en anden bruger eller virksomhed, så skriv til os, så vi kan tage stilling til passende handling i sagen.<br>
         </p>
      </div>
   </div>

   <div class="row d-flex align-items-center">
      <div class="col">
            <h2>{{ title_case(__('contact formular')) }}</h2>
            {{ Form::open(['route' => 'pages.contact.post']) }}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
               {{ Form::label(ucfirst(__('name'))) }}
               {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
               <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
               {{ Form::label(ucfirst(__('email'))) }}
               {{ Form::text('email', old('email'), ['class' => 'form-control']) }}
               <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
            <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
               {{ Form::label(ucfirst(__('message'))) }}
               {{ Form::textarea('message', old('message'), ['class' => 'form-control']) }}
               <span class="text-danger">{{ $errors->first('message') }}</span>
            </div>
            <div class="form-group">
               <button class="btn btn-castme">{{ ucfirst(__('contact')) }}</button>
            </div>
            {{ Form::close() }}
         </div>
     </div>

</div>
@endsection