<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk di tampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten -->
@section('content')

<style>
    body {
        min-height: 100vh;
        background: #F6F4EF;
    }

    .login-card {
        width: 22.5rem;
        border: 1px solid #E4E0D6;
        border-radius: 14px;
        box-shadow: none;
        overflow: hidden;
    }

    .login-card .card-header {
        background: #fff;
        border-bottom: none;
        padding: 2.5rem 2rem 0.5rem;
        text-align: center;
    }

    .login-icon {
        width: 36px;
        height: 36px;
        margin: 0 auto 1.25rem;
        border-radius: 9px;
        background: #2F6B4F;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-icon svg {
        width: 18px;
        height: 18px;
    }

    .login-card .card-header h5 {
        font-weight: 700;
        font-size: 1.2rem;
        color: #20241F;
        margin-bottom: 0.35rem;
    }

    .login-subtitle {
        font-size: 0.85rem;
        color: #8A8474;
        margin-bottom: 0;
    }

    .login-card .card-body {
        padding: 1.25rem 2rem 2rem;
    }

    .login-card .form-label {
        font-weight: 500;
        font-size: 0.8rem;
        text-align: left;
        display: block;
        color: #20241F;
        margin-bottom: 0.45rem;
    }

    .login-card .form-control {
        border-radius: 8px;
        border: 1px solid #E4E0D6;
        background: #FCFBF8;
        padding: 0.65rem 0.85rem;
        font-size: 0.9rem;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .login-card .form-control:focus {
        border-color: #2F6B4F;
        box-shadow: 0 0 0 3px rgba(47, 107, 79, 0.13);
        background: #fff;
    }

    .login-card .btn-primary {
        width: 100%;
        background: #2F6B4F;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.92rem;
        padding: 0.65rem;
        margin-top: 0.5rem;
        transition: background 0.15s ease;
    }

    .login-card .btn-primary:hover {
        background: #204935;
    }

    .login-card .btn-primary:active {
        transform: translateY(1px);
    }

    .login-card .badge.text-bg-danger {
        font-weight: 500;
        font-size: 0.72rem;
        border-radius: 6px;
    }
</style>

<div class="card text-center position-absolute top-50 start-50 translate-middle login-card">
    <div class="card-header">
        <div class="login-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="7" width="18" height="13" rx="1"></rect>
                <path d="M8 7V5a4 4 0 0 1 8 0v2"></path>
            </svg>
        </div>
        <h5>Login POS</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nama@contoh.com" value="{{ old('email') }}">
                @error('email')
                    <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 text-start">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan kata sandi">
                @error('password')
                    <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>
    </div>
</div>

<!-- batas Akhir isi konten -->
@endsection