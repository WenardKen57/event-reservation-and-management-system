<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Meal Package</title>
    <link rel="stylesheet" href="{{ asset('css/admin/packages/meal-packages-create.css') }}">
</head>
<body>

    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <strong>There were some errors with your submission:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    

    <div class="container">
        <h2>Create Meal Package</h2>

        <form action="{{ route('admin.meal-packages.store') }}" method="POST">
            @csrf
            <label>Package Name:</label>
            <input type="text" name="name" required>

            <label for="total_price">Package total price: (Per Plate)</label>
            <input type="number" name="total_price" placeholder="total price per plate" required>

            <div id="inclusions">
                <div class="inclusion-item">
                    <label>Inclusion Item:</label>
                    <input type="text" name="inclusions[0][item_name]" required>
                </div>
            </div>

            <button type="button" class="btn-secondary" onclick="addInclusion()">Add More</button>
            <button type="submit">Create Package</button>
        </form>
    </div>

    <script>
        let count = 1;
        function addInclusion() {
            let div = document.createElement('div');
            div.classList.add('inclusion-item');
            div.innerHTML = `
                <label>Inclusion Item:</label>
                <input type="text" name="inclusions[${count}][item_name]" required>
            `;
            document.getElementById('inclusions').appendChild(div);
            count++;
        }
    </script>

</body>
</html>
