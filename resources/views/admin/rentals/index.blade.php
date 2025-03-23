<h2 class="text-xl font-bold">Rental Items</h2>
<a href="{{ route('admin.rentals.create') }}" class="btn btn-primary">Add New Rental Item</a>

<table class="table-auto w-full mt-4 border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border p-2">Name</th>
            <th class="border p-2">Category</th>
            <th class="border p-2">Price</th>
            <th class="border p-2">Unit</th>
            <th class="border p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rentalItems as $item)
            <tr>
                <td class="border p-2">{{ $item->name }}</td>
                <td class="border p-2">{{ $item->category }}</td>
                <td class="border p-2">₱{{ number_format($item->price, 2) }}</td>
                <td class="border p-2">{{ $item->unit }}</td>
                <td class="border p-2">
                    <a href="{{ route('admin.rentals.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.rentals.destroy', $item->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this rental item?');">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>