<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/create-reservation.css') }}">
    <h1 class="header-title">Make an event reservation</h1>

    <div class="container">
        <form action="{{ route('customer.reservation.store') }}" method="POST" class="form-container">
            @csrf

            <a href="{{ route('event.packages') }}" target="_blank">
                <button type="button" id="offered-packages-btn">
                    See offered packages
                </button>
            </a>

            <!-- Event Type Selection -->
            <label class="form-label">Select Event Type:</label>
            <select id="event-type-select" class="form-select" required>
                <option value="">-- Select Event Type --</option>
                <option value="wedding">Wedding</option>
                <option value="birthday">Birthday</option>
                <option value="others">Others</option>
            </select>

            <!-- Package Selection -->
            <label class="form-label">Select a Package:</label>
            <select name="package_id" id="package-select" class="form-select" required>
                <option value="" data-image="">-- Select a Package --</option>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}" 
                            data-image="{{ asset('storage/' . $package->image) }}" 
                            data-event-type="{{ $package->event_type }}"
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

            <a href="{{ route('event.packages') }}" target="_blank">
                <button type="button" id="offered-packages-btn">
                    See offered packages
                </button>
            </a>
            
            <label class="block text-gray-700 font-semibold mb-2">Select Meal Package:</label>
            <select name="meal_package_id" id="meal-package-select" 
                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- No Meal Package --</option>
                @foreach($mealPackages as $package)
                    <option value="{{ $package->id }}" data-inclusions="{{ json_encode($package->inclusions) }}">
                        {{ $package->name }} - ₱{{ number_format($package->total_price, 2) }}
                    </option>
                @endforeach
            </select>

            <!-- Meal Package Inclusions Display -->
            <div id="meal-package-inclusions" class="hidden bg-gray-100 p-4 rounded-lg mt-4 shadow-md">
                <h4 class="text-lg font-bold text-gray-800">Inclusions (Per plate):</h4>
                <ul id="inclusions-list" class="list-disc pl-5 text-gray-700 mt-2 space-y-1"></ul>
            </div>

            <h2>Select Rental Items:</h2>
            <div id="rental-items-container">
                @foreach($rentalItems as $item)
                    <div class="rental-item">
                        <input type="checkbox" name="rental_items[{{ $item->id }}][id]" value="{{ $item->id }}" 
                            data-price="{{ $item->price }}" class="rental-checkbox">
                        <label>{{ $item->name }} - ₱{{ number_format($item->price, 2) }}</label>
                        <input type="number" name="rental_items[{{ $item->id }}][quantity]" min="1" value="1" 
                            class="rental-quantity hidden" data-item-id="{{ $item->id }}">
                    </div>
                @endforeach
            </div>

            <p><strong>Total Rental Price: </strong>₱<span id="total-rental-price">0.00</span></p>


            <!-- Submit Button -->
            <button type="submit" class="btn-primary">
                Submit Reservation
            </button>
        </form>
    </div>

    <script src="{{ asset('js/create-reservation.js') }}"></script>

    <script>

        document.addEventListener("DOMContentLoaded", function () {
            const selectElement = document.getElementById("meal-package-select");
            const inclusionsContainer = document.getElementById("meal-package-inclusions");
            const inclusionsList = document.getElementById("inclusions-list");

            selectElement.addEventListener("change", function () {
                inclusionsList.innerHTML = ""; // Clear existing inclusions

                let selectedOption = selectElement.options[selectElement.selectedIndex];
                let inclusions = selectedOption.getAttribute("data-inclusions");

                if (inclusions && inclusions !== "null") {
                    inclusions = JSON.parse(inclusions); // Convert from JSON string to JS object
                    
                    if (inclusions.length > 0) {
                        inclusions.forEach(item => {
                            let listItem = document.createElement("li");
                            listItem.textContent = `${item.item_name}`;
                            inclusionsList.appendChild(listItem);
                        });

                        inclusionsContainer.classList.remove("hidden"); // Show inclusions container
                    } else {
                        inclusionsContainer.classList.add("hidden"); // Hide if no inclusions
                    }
                } else {
                    inclusionsContainer.classList.add("hidden"); // Hide if no package is selected
                }
            });
        });

        document.getElementById('event-type-select').addEventListener('change', function() {
            let selectedEventType = this.value;
            let packageSelect = document.getElementById('package-select');
            
            // Reset package selection
            packageSelect.innerHTML = '<option value="">-- Select a Package --</option>';

            // Loop through all package options and filter by event type
            @foreach ($packages as $package)
                if ('{{ $package->event_type }}' === selectedEventType) {
                    let option = document.createElement('option');
                    option.value = '{{ $package->id }}';
                    option.textContent = '{{ $package->package_name }} - ${{ number_format($package->total_price, 2) }}';
                    option.setAttribute('data-image', '{{ asset('storage/' . $package->image) }}');
                    packageSelect.appendChild(option);
                }
            @endforeach
        });

        const eventPackageSelect = document.getElementById("package-select");
        const mealPackageSelect = document.getElementById("meal-package-select");
        const rentalCheckboxes = document.querySelectorAll(".rental-checkbox");
        const totalPriceElement = document.getElementById("total-rental-price");
        const finalTotalElement = document.createElement("p");
        
        finalTotalElement.innerHTML = `<strong>Final Total Price: </strong>₱<span id="final-total-price">0.00</span>`;
        totalPriceElement.parentNode.appendChild(finalTotalElement);
        
        function updateTotalPrice() {
            let eventPackageSelect = document.getElementById("package-select");
            let mealPackageSelect = document.getElementById("meal-package-select");
            let rentalCheckboxes = document.querySelectorAll(".rental-checkbox");
            let totalPriceElement = document.getElementById("total-rental-price");

            let eventPackagePrice = 0;
            let selectedPackage = eventPackageSelect.options[eventPackageSelect.selectedIndex];

            if (selectedPackage) {
                let match = selectedPackage.textContent.match(/\$([\d,.]+)/); // Extract price from "$XXX.XX"
                if (match) {
                    eventPackagePrice = parseFloat(match[1].replace(",", ""));
                }
            }

            let mealPackagePrice = 0;
            let selectedMealPackage = mealPackageSelect.options[mealPackageSelect.selectedIndex];

            if (selectedMealPackage) {
                let match = selectedMealPackage.textContent.match(/₱([\d,.]+)/); // Extract price from "₱XXX.XX"
                if (match) {
                    mealPackagePrice = parseFloat(match[1].replace(",", ""));
                }
            }

            let rentalTotal = 0;

            document.querySelectorAll(".rental-checkbox:checked").forEach((checkbox) => {
                let quantityInput = checkbox.parentElement.querySelector(".rental-quantity");
                let quantity = parseInt(quantityInput.value) || 0;
                let price = parseFloat(checkbox.getAttribute("data-price")) || 0;

                if (quantity < 1) {
                    quantity = 1; 
                    quantityInput.value = 1;
                }
                rentalTotal += price * quantity;
            });

            totalPriceElement.textContent = rentalTotal.toFixed(2);
            let finalTotal = eventPackagePrice + mealPackagePrice + rentalTotal;
            document.getElementById("final-total-price").textContent = finalTotal.toFixed(2);
        }


        eventPackageSelect.addEventListener("change", updateTotalPrice);
        mealPackageSelect.addEventListener("change", updateTotalPrice);

        rentalCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                let quantityInput = this.parentElement.querySelector(".rental-quantity");
                quantityInput.classList.toggle("hidden", !this.checked);
                if (this.checked) {
                    quantityInput.value = 1; 
                }
                updateTotalPrice();
            });
        });

        document.querySelectorAll(".rental-quantity").forEach((input) => {
            input.addEventListener("input", updateTotalPrice);
        });

        updateTotalPrice(); 

    </script>
</x-app-layout>
