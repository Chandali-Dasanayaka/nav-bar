document.getElementById("contactForm").addEventListener("submit", function(event) {
  event.preventDefault(); // prevent default form submission

  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const message = document.getElementById("message").value.trim();
  const error = document.getElementById("error");

  if (name === "" || email === "" || message === "") {
    error.textContent = "All fields are required.";
    return;
  }

  // Basic email pattern check
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!email.match(emailPattern)) {
    error.textContent = "Please enter a valid email address.";
    return;
  }

  // If passed all checks
  error.textContent = "";
  alert("Form submitted successfully!");
  // Optionally: document.getElementById("contactForm").submit();
});
