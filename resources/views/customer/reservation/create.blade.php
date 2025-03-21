<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title">
            {{ __('Make an Event Reservation') }}
        </h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('customer.reservation.store') }}" method="POST" class="form-container">
            @csrf

            <!-- Package Selection -->
            <label class="form-label">Select a Package:</label>
            <select name="package_id" id="package-select" class="form-select" required>
                <option value="" data-image="">-- Select a Package --</option>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}" data-image="{{ asset('storage/' . $package->image) }}" 
                        {{ old('package_id') == $package->id ? 'selected' : '' }}>
                        {{ $package->package_name }} - ${{ number_format($package->total_price, 2) }}
                    </option>
                @endforeach
            </select>
            @error('package_id')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <!-- Display Package Image -->
            <div class="image-container">
                <img id="package-image" src="" alt="Selected Package Image" class="hidden">
            </div>

            <!-- Event Details -->
            <label class="form-label">Event Name:</label>
            <input type="text" name="event_name" class="form-input" value="{{ old('event_name') }}" required>
            @error('event_name')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label class="form-label">Event Date:</label>
            <select name="event_date" class="form-select" required>
                <option value="">-- Select an Available Date --</option>
                @foreach ($availableDates as $date)
                    <option value="{{ $date }}" {{ old('event_date') == $date ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}
                    </option>
                @endforeach
            </select>
            @error('event_date')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label class="form-label">Event Time:</label>
            <input type="time" name="event_time" class="form-input" value="{{ old('event_time') }}" required>
            @error('event_time')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label class="form-label">Event Location:</label>
            <input type="text" name="event_location" class="form-input" value="{{ old('event_location') }}" required>
            @error('event_location')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label class="form-label">Number of Guests:</label>
            <input type="number" name="guests" class="form-input" value="{{ old('guests') }}" required>
            @error('guests')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label class="form-label">Event Type:</label>
            <select name="event_type" class="form-select">
                <option value="wedding" {{ old('event_type') == 'wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="birthday" {{ old('event_type') == 'birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="corporate" {{ old('event_type') == 'corporate' ? 'selected' : '' }}>Corporate Event</option>
                <option value="others" {{ old('event_type') == 'others' ? 'selected' : '' }}>Others</option>
            </select>
            @error('event_type')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <label class="form-label">Special Requests:</label>
            <textarea name="special_requests" class="form-textarea">{{ old('special_requests') }}</textarea>
            @error('special_requests')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <!-- Submit Button -->
            <button type="submit" class="btn-primary">
                Submit Reservation
            </button>
        </form>
    </div>

    <!-- JavaScript for Dynamic Image Display -->
    <script>
        document.getElementById('package-select').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let imageUrl = selectedOption.getAttribute('data-image');
            let packageImage = document.getElementById('package-image');

            if (imageUrl) {
                packageImage.src = imageUrl;
                packageImage.classList.remove('hidden');
            } else {
                packageImage.classList.add('hidden');
            }
        });
    </script>

    <style>
        /* General Styling */
        * {
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .header-title {
            font-size: 24px;
            font-weight: bold;
            color: white;
            background-color: #2563eb;
            padding: 16px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Form Container */
        .container {
            max-width: 70vw;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Form Fields */
        .form-label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border 0.3s ease-in-out;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 5px rgba(37, 99, 235, 0.5);
        }

        /* Submit Button */
        .btn-primary {
            background-color: #2563eb;
            color: white;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            width: 100%;
            display: block;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background-color: #1e40af;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .form-input, .form-select, .form-textarea {
                font-size: 14px;
            }
        }
    </style>
</x-app-layout>
