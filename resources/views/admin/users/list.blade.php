@extends('layouts.master')
@section('content')

{{-- Check if no users or all users are disabled --}}
@if (!count($users))
    <div class="page-header">{{ ucfirst(__('no users')) }}</div>
@else
    <div class="page-header">{{ $title }}</div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Avatar</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Created By</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td><img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="{{ ucfirst(__('avatar')) }}"></td>
                <td><a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->name }} {{ $user->last_name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                @if ($user->createdBy)
                <td><a href="{{ route('profile', ['id' => $user->createdBy->id]) }}">{{ $user->createdBy->name }} {{ $user->createdBy->last_name }}</a></td>
                @else
                <td></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection