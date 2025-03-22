<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/create-reservation.css') }}">
    <h1 class="header-title">Make an event reservation</h1>

    <div class="container">
        <form action="{{ route('customer.reservation.store') }}" method="POST" class="form-container">
            @csrf

            <a href="{{ route('customer.event.packages') }}" target="_blank">See offered packages</a>
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

            <h2>Additional services:</h2>

            <label>Select Meal Package:</label>
            <select name="meal_package_id">
                <option value="">-- No Meal Package --</option>
                @foreach($mealPackages as $package)
                    <option value="{{ $package->id }}">
                        {{ $package->name }} - ₱{{ number_format($package->total_price, 2) }}
                    </option>
                @endforeach
            </select>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary">
                Submit Reservation
            </button>
        </form>
    </div>

    <script src="{{ asset('js/create-reservation.js') }}"></script>

</x-app-layout>
