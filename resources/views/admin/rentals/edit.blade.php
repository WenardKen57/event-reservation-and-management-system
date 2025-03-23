
<h2 class="text-xl font-bold">Edit Rental Item</h2>

<form action="{{ route('admin.rentals.update', $rentalItem->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $rentalItem->name) }}" required class="form-input">
    </div>
    <div>
        <label>Category:</label>
        <input type="text" name="category" value="{{ old('category', $rentalItem->category) }}" required class="form-input">
    </div>
    <div>
        <label>Price:</label>
        <input type="number" name="price" value="{{ old('price', $rentalItem->price) }}" min="0" step="0.01" required class="form-input">
    </div>
    <div>
        <label>Unit:</label>
        <input type="text" name="unit" value="{{ old('unit', $rentalItem->unit) }}" required class="form-input">
    </div>

    <button type="submit" class="btn btn-primary">Update Rental Item</button>
</form>

