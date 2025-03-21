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