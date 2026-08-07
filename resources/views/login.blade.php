<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk di tampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten -->
@section('content')

<style>
    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #E1F5EE 0%, #F5F3EA 50%, #E6F1FB 100%);
    }
 
    .login-card {
        width: 23rem;
        border: none;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(18, 84, 57, 0.20);
        overflow: hidden;
        animation: cardIn 0.4s ease;
    }
 
    @keyframes cardIn {
        from { opacity: 0; transform: translate(-50%, -46%); }
        to { opacity: 1; transform: translate(-50%, -50%); }
    }
 
    .login-card .card-header {
        background: #fff;
        border-bottom: none;
        padding: 2rem 1.5rem 0.5rem;
    }
 
    .login-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 0.75rem;
        border-radius: 14px;
        background: linear-gradient(135deg, #1C7C54, #2FA372);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 16px -4px rgba(28, 124, 84, 0.4);
    }
 
    .login-icon svg {
        width: 26px;
        height: 26px;
        fill: #fff;
    }
 
    .login-card .card-header h5 {
        font-weight: 700;
        font-size: 1.25rem;
        color: #1f2d27;
        margin-bottom: 0.25rem;
    }
 
    .login-subtitle {
        font-size: 0.82rem;
        color: #8a938e;
        margin-bottom: 1.25rem;
    }
 
    .login-card .card-body {
        padding: 1rem 1.75rem 2rem;
    }
 
    .login-card .form-label {
        font-weight: 600;
        font-size: 0.82rem;
        text-align: left;
        display: block;
        color: #3d4c46;
        margin-bottom: 0.4rem;
    }
 
    .login-card .form-control {
        border-radius: 10px;
        border: 1.5px solid #E4E1D8;
        padding: 0.65rem 0.9rem;
        font-size: 0.92rem;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
 
    .login-card .form-control:focus {
        border-color: #1C7C54;
        box-shadow: 0 0 0 4px rgba(28, 124, 84, 0.12);
    }
 
    .login-card .btn-primary {
        width: 100%;
        background: linear-gradient(135deg, #1C7C54, #2FA372);
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.7rem;
        margin-top: 0.75rem;
        box-shadow: 0 10px 20px -6px rgba(28, 124, 84, 0.45);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
 
    .login-card .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px -6px rgba(28, 124, 84, 0.5);
    }
 
    .login-card .btn-primary:active {
        transform: translateY(0);
    }
 
    .login-card .badge.text-bg-danger {
        font-weight: 500;
        font-size: 0.72rem;
        border-radius: 6px;
    }
</style>
 

<div class="card text-center position-absolute top-50 start-50 translate-middle login-card">
    <h5 class="card-header">Login POS</h5>
    <div class="card-body">
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('email')
                    <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                @error('password')
                    <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<!-- batas Akhir isi konten -->
@endsection