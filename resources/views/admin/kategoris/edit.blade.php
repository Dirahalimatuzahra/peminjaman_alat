<form action="{{ route('admin.kategoris.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT') <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}">
    <button type="submit">Update</button>
</form>
