// Get the container element
var categoryContainer = document.getElementsByClassName("category");

// Get all buttons with class="btn" inside the container
var items = document.getElementsByClassName("category-item");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < items.length; i++) {
    items[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("active");

        // If there's no active class
        if (current.length > 0) {
            current[0].className = current[0].className.replace(" active", "");
        }

        // Add the active class to the current/clicked button
        this.className += " active";
    });
}