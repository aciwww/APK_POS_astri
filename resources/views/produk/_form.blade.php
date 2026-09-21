@csrf 

@if (!empty($produk->foto))
    <div class="mb-2">
        <label>Foto Saat Ini</label><br>
        <img src="{{ asset('storage/' . $produk->foto) }}"
            width="150"
            class="img-thumbnail">
    </div>
@endif    

<div class="row">
    <div class="col">
        <div>
            <label>Gambar</label>
            <input type="file"
                name="foto"
                onchange="previewImage(this)"
                class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror            
        </div>
    </div>

    <div class="col">
        <div class="mb-2">
            <label>Preview Foto</label><br>
            <img id="preview" class="img-thumbnail mt-2" style="display:none" width="150">
        </div>
    </div>
</div>   

<!-- Jenis Produk -->
            <div class="col-12">
                <label for="jenis_id" class="form-label fw-semibold">Jenis Produk</label>
                <select id="jenis_id" 
                        name="jenis_id" 
                        class="form-select @error('jenis_id') is-invalid @enderror">
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenis as $j)
                        <option value="{{ $j->id }}" 
                            {{ old('jenis_id', $produk->jenis_id ?? '') == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jenis }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

<div>
    <label>Nama Produk</label><br>
    <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $produk->nama ?? '') }}">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror 
</div>
<div>
    <label>Harga Beli</label><br>
    <input type="number" name="purchase_price"
           class="form-control @error('purchase_price') is-invalid @enderror"
           value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
       @error('purchase_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
       @enderror
</div>

<div>
    <label>Harga Jual</label><br>
    <input type="number" name="selling_price"
           class="form-control @error('selling_price') is_invalid @enderror"
           value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
        @error('selling_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
</div>

<div>
    <label>Stok</label><br>
    <input type="number" name="stock"
           class="form-control @error('stock') is-invalid @enderror"
           value="{{ old('stock', $produk->stok?? '') }}">
         @error('stock')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
</div>

<div>
    <label>Satuan</label><br>
    <select name="unit"
            class="form-control @error('unit') is-invalid @enderror">
        <option value="">-- Pilih Satuan --</option>
        <option value="pcs" {{ old('unit', $produk->satuan ?? '') == 'pcs' ? 'selected' : '' }}>Pcs</option>
        <option value="lusin" {{ old('unit', $produk->satuan ?? '') == 'lusin' ? 'selected' : '' }}>Lusin</option>
        <option value="pack" {{ old('unit', $produk->satuan ?? '') == 'pack' ? 'selected' : '' }}>Pack</option>
        <option value="set" {{ old('unit', $produk->satuan ?? '') == 'set' ? 'selected' : '' }}>Set</option>
        <option value="meter" {{ old('unit', $produk->satuan ?? '') == 'meter' ? 'selected' : '' }}>Meter</option>
    </select>
    @error('unit')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Isi per Satuan (dalam pcs)</label><br>
    <input type="number" name="content_per_unit" min="1"
           class="form-control @error('content_per_unit') is-invalid @enderror"
           value="{{ old('content_per_unit', $produk->isi_per_satuan ?? 1) }}">
    @error('content_per_unit')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button class="btn btn-success mt-3" type="submit">Simpan</button>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>
<a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>