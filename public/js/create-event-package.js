document.addEventListener("DOMContentLoaded", function () {
  const addInclusionButton = document.querySelector('#new-inclusion');
  const inclusionsContainer = document.querySelector('#inclusions-container');

  addInclusionButton.addEventListener('click', () => {
      let wrapper = document.createElement('div');
      wrapper.style.display = "flex";
      wrapper.style.gap = "10px";
      wrapper.style.marginBottom = "5px";
      wrapper.style.alignItems = "center";

      // Inclusion Input
      let inclusionInput = document.createElement('input');
      inclusionInput.type = "text";
      inclusionInput.name = "inclusions[]"; // Array for Laravel
      inclusionInput.placeholder = "Enter inclusion";
      inclusionInput.required = true;

      // Quantity Input
      let quantityInput = document.createElement('input');
      quantityInput.type = "number";
      quantityInput.name = "quantities[]"; // Array for Laravel
      quantityInput.placeholder = "Qty";
      quantityInput.min = "1";
      quantityInput.required = true;

      // Remove Button
      let removeButton = document.createElement('button');
      removeButton.textContent = "Remove";
      removeButton.type = "button";
      removeButton.addEventListener('click', () => {
          wrapper.remove();
      });

      // Append Inputs and Remove Button to Wrapper
      wrapper.appendChild(inclusionInput);
      wrapper.appendChild(quantityInput);
      wrapper.appendChild(removeButton);
      inclusionsContainer.appendChild(wrapper);
  });

  document.getElementById('package_image').addEventListener('change', function(event) {
    let reader = new FileReader();
    reader.onload = function() {
        let imagePreview = document.getElementById('image-preview');
        imagePreview.src = reader.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
  });
});
