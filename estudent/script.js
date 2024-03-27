document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var formData = new FormData(this);

    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            document.getElementById('message').textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
