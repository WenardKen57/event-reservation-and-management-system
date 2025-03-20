// Get buttons
const eventBtn = document.getElementById("event-btn");
const rentalBtn = document.getElementById("rental-btn");
const mealBtn = document.getElementById("meal-btn");

// Get divs
const eventDiv = document.getElementById("event");
const rentalDiv = document.getElementById("rental");
const mealDiv = document.getElementById("meal");

// Function to hide all divs
function hideAll() {
    eventDiv.style.display = "none";
    rentalDiv.style.display = "none";
    mealDiv.style.display = "none";
}

// Add event listeners to buttons
eventBtn.addEventListener("click", function () {
    hideAll();
    eventDiv.style.display = "block";
});

rentalBtn.addEventListener("click", function () {
    hideAll();
    rentalDiv.style.display = "block";
});

mealBtn.addEventListener("click", function () {
    hideAll();
    mealDiv.style.display = "block";
});

hideAll(); // Hide all initiaily