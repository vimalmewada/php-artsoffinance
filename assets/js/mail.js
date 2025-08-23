function showPopup(type, message) {
    let iconDiv = document.getElementById("popup-icon");
    let msgDiv = document.getElementById("popup-message");

    // Reset
    iconDiv.className = "";
    msgDiv.textContent = message;

    if (type === "loading") {
        iconDiv.classList.add("spinner");
    } else if (type === "success") {
        iconDiv.classList.add("checkmark");
    } else if (type === "error") {
        iconDiv.classList.add("crossmark");
    }

    let popup = document.getElementById("popup-modal");
    popup.style.display = "flex";

    // Auto close after 2.5s (except loading)
    if (type !== "loading") {
        setTimeout(() => {
            popup.style.display = "none";
        }, 2500);
    }
}

// Example with form
document.getElementById("contact-form").addEventListener("submit", function (e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(form);

    showPopup("loading", "Sending...");

    fetch("/api/submit-contact", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showPopup("success", "Message sent successfully!");
                form.reset();
            } else {
                showPopup("error", data.message || "Something went wrong.");
            }
        })
        .catch(() => {
            showPopup("error", "Something went wrong. Please try again.");
        });
});
    