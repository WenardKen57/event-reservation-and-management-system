<h2 class="text-xl font-bold">Add Rental Item</h2>

<form action="{{ route('admin.rentals.store') }}" method="POST">
    @csrf
    <div>
        <label>Name:</label>
        <input type="text" name="name" required class="form-input">
    </div>
    <div>
        <label>Category:</label>
        <input type="text" name="category" required class="form-input">
    </div>
    <div>
        <label>Price:</label>
        <input type="number" name="price" min="0" step="0.01" required class="form-input">
    </div>
    <div>
        <label>Unit:</label>
        <input type="text" name="unit" required class="form-input">
    </div>
    <button type="submit" class="btn btn-success">Add Rental Item</button>
</form>