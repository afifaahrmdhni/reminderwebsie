<!-- Modal Edit -->
<div class="modal fade" id="editCategoryModal{{ $item->id }}" tabindex="-1" aria-labelledby="editCategoryLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryLabel{{ $item->id }}">Edit Kategori Reminder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('product-admin.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Kategori barang/produk</label>
            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi barang/produk</label>
            <input type="text" name="deskripsi" class="form-control" value="{{ $item->deskripsi }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div> 
  </div>
</div>
