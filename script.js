document.getElementById('contactForm').addEventListener('submit', function (e) {
    const contact = document.querySelector('input[name="contact"]').value;
    if (!/^[\d\s+()-]{7,15}$/.test(contact)) {
      e.preventDefault();
      document.getElementById('status').textContent = "Please enter a valid contact number.";
    }
  });
  