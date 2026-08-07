@extends('layouts.app')

@section('title', 'Users')

@section('content')

<style>
    body {
        background: linear-gradient(160deg, #E1F5EE 0%, #F7F5EE 45%, #E6F1FB 100%);
        background-attachment: fixed;
        min-height: 100vh;
    }

    .btn-primary {
        background-color: #1C7C54;
        border-color: #1C7C54;
    }
    .btn-primary:hover {
        background-color: #125439;
        border-color: #125439;
    }

    .btn-outline-secondary {
        color: #1C7C54;
        border-color: #1C7C54;
    }
    .btn-outline-secondary:hover {
        background-color: #1C7C54;
        border-color: #1C7C54;
        color: #fff;
    }

    .btn-warning {
        background-color: #E8A33D;
        border-color: #E8A33D;
        color: #fff;
    }
    .btn-warning:hover {
        background-color: #b87a22;
        border-color: #b87a22;
        color: #fff;
    }

    .btn-danger {
        background-color: #E24B4A;
        border-color: #E24B4A;
    }
    .btn-danger:hover {
        background-color: #b73534;
        border-color: #b73534;
    }

    .table thead th {
        background-color: #F7F5EE;
    }
    .table tbody tr:hover {
        background-color: #E1F5EE;
    }
</style>

@include('layouts.navbar')

<div class="container m-3"></div>
<h2>Users</h2>
<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create</a>

<form action="{{ route('admin.users') }}" method="GET" class="mb-3">
  <div class="input-group">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        class="form-control"
        placeholder="search username or email">

      <button class="btn btn-outline-secondary" type="submit">
        Search
      </button>  
  </div>
</form>
  
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{ $users->firstItem() + $loop->index }}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role->name}}</td>
        <td>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                Edit Akun
            </a>
            ||
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                @csrf 
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                    Hapus 
                </button>    
            </form>
        </td>
    </tr>    
    @endforeach
  </tbody>
</table>
{{ $users->links() }}
@endsection