
document.getElementById("contact-form").addEventListener("submit", function (e) {
    e.preventDefault(); // prevent page reload

    let form = this;
    let formData = new FormData(form);

    fetch("/submit-contact", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            let msgDiv = document.getElementById("form-message");
            msgDiv.innerHTML = data.message;
            msgDiv.style.color = data.success ? "green" : "red";

            if (data.success) {
                form.reset(); // clear form if success
            }
        })
        .catch(error => {
            document.getElementById("form-message").innerHTML = "Error: " + error;
        });
});



