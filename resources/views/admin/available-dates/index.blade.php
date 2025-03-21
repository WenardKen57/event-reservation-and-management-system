<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title">
            Manage Available Dates
        </h2>
    </x-slot>

    <div class="container">
        <!-- Add Date Form -->
        <form action="{{ route('admin.available-dates.store') }}" method="POST" class="date-form">
            @csrf
            <label for="date" class="label">Select Available Date:</label>
            <input type="date" name="date" id="date" class="date-input" required>
            <button type="submit" class="add-btn">Add Date</button>
        </form>

        <!-- Display Available Dates -->
        <h3 class="section-title">Available Dates</h3>
        <ul class="date-list">
            @foreach ($availableDates as $date)
                <li class="date-item">
                    <span class="date-text">{{ \Carbon\Carbon::parse($date->date)->format('F d, Y') }}</span>
                    <form action="{{ route('admin.available-dates.destroy', $date->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

    <style>
        /* General Layout */
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);
            border: 1px solid #90CAF9;
        }

        /* Header Styling */
        .header-title {
            font-size: 20px;
            color: white;
            background: #1E88E5;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 255, 0.3);
        }

        /* Form Styling */
        .date-form {
            background: #E3F2FD;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 255, 0.2);
        }

        .label {
            font-weight: bold;
            color: #1565C0;
            display: block;
            margin-bottom: 8px;
        }

        .date-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #64B5F6;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        /* Button Styling */
        .add-btn {
            width: 100%;
            background: #1E88E5;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .add-btn:hover {
            background: #1565C0;
        }

        /* Available Dates Section */
        .section-title {
            font-size: 18px;
            color: #1565C0;
            margin-bottom: 10px;
        }

        .date-list {
            list-style: none;
            padding: 0;
        }

        .date-item {
            background: #BBDEFB;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 255, 0.2);
        }

        .date-text {
            font-size: 16px;
            font-weight: bold;
            color: #0D47A1;
        }

        .remove-btn {
            background: #D32F2F;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        .remove-btn:hover {
            background: #B71C1C;
        }
    </style>

</x-app-layout>
