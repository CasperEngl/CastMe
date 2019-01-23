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
            <th scope="col">Role</th>
            <th scope="col">Created By</th>
            <th scope="col">Active</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td><img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="{{ ucfirst(__('avatar')) }}" height="30"></td>
                <td><a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->name }} {{ $user->last_name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->role }}</td>
                @if ($user->createdBy)
                <td><a href="{{ route('profile', ['id' => $user->createdBy->id]) }}">{{ $user->createdBy->name }} {{ $user->createdBy->last_name }}</a></td>
                @else
                <td></td>
                @endif
                @if ($user->deleted_at)
                <td><a href="{{ route('admin.user.toggle', ['id' => $user->id]) }}" class="btn btn-warning" onclick="return confirm('{{ sentence(__('are you sure you want to enable this user?')) }}')">{{ ucfirst(__('enable')) }}</a></td>
                @else
                <td><a href="{{ route('admin.user.toggle', ['id' => $user->id]) }}" class="btn btn-danger" onclick="return confirm('{{ sentence(__('are you sure you want to disable this user?')) }}')">{{ ucfirst(__('disable')) }}</a></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection