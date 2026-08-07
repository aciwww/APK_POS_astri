@csrf

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

<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $user->name ?? '') }}">
   @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>        
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $user->email ?? '') }}">
     @error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>        
    @enderror       
</div>

<div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password"
           class="form-control  @error('password') is-invalid @enderror">
    @error('password')
    <div class="invalid-feedback">
        {{ $message }}
    </div>        
    @enderror              
</div>

<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role_id"
            class="form-select @error('password') is-invalid @enderror">
        <option value="">-- Pilih Role -- </option>
        @foreach($roles as $role)
        <option value="{{ $role->id }}"
            @selected(old('role_id', $user->role_id ?? '') == $role->id)>
            {{ ucfirst($role->name) }}
        </option>    
      @endforeach
    </select>
   @error('role_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>        
    @enderror             
</div>

<button class="btn btn-success">Simpan</button>
<a href="{{ route('admin.users') }}" class="btn btn-secondary">Kembali</a>