                        <div id="form-message"></div>
                        <form id="contact-form" method="POST">
                            <div class="name-email">
                                <input type="text" name="name" placeholder="Your Name*" required>
                                <input type="email" name="email" placeholder="Email Address">
                            </div>
                            <input type="text" name="mobileNumber" placeholder="Mobile Number*" required>
                            <textarea placeholder="Type Your Message" name="message"></textarea>
                            <button type="submit" class="rts-btn btn-primary">Send Message</button>
                        </form>

<div id="popup-modal">
    <div class="popup-box">
        <div class="popup-icon" id="popup-icon"></div>
        <div class="popup-text" id="popup-message">Sending...</div>
    </div>
</div>
<style>
/* Overlay */
#popup-modal {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.35);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

/* Box */
.popup-box {
    background: #fff;
    padding: 30px 40px;
    border-radius: 14px;
    text-align: center;
    max-width: 320px;
    width: 90%;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    animation: popIn 0.35s ease;
}

/* Animation */
@keyframes popIn {
    from { opacity: 0; transform: scale(0.7) translateY(20px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

/* Spinner (Loading) */
.spinner {
    width: 45px;
    height: 45px;
    border: 5px solid #ddd;
    border-top: 5px solid #007bff;
    border-radius: 50%;
    margin: 0 auto 12px;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    100% { transform: rotate(360deg); }
}

/* Success Check */
.checkmark {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #28a745;
    position: relative;
    margin: 0 auto 12px;
}
.checkmark::after {
    content: "";
    position: absolute;
    left: 12px;
    top: 8px;
    width: 12px;
    height: 24px;
    border: solid #fff;
    border-width: 0 4px 4px 0;
    transform: rotate(45deg);
}

/* Error Cross */
.crossmark {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #dc3545;
    position: relative;
    margin: 0 auto 12px;
}
.crossmark::before, .crossmark::after {
    content: "";
    position: absolute;
    top: 12px; left: 12px;
    width: 20px;
    height: 4px;
    background: #fff;
}
.crossmark::before { transform: rotate(45deg); }
.crossmark::after { transform: rotate(-45deg); }


</style>
