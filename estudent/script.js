document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var formData = new FormData(this);

    fetch('backend.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Change response type to text
    .then(data => {
        try {
            // Try parsing the response as JSON
            const jsonData = JSON.parse(data);
            if (jsonData.success) {
                window.location.href = jsonData.redirect;
            } else {
                document.getElementById('message').textContent = jsonData.message;
            }
        } catch (error) {
            // If parsing as JSON fails, handle the error
            console.error('Error parsing JSON:', error);
            // Assuming the response is HTML, you can directly inject it into the message div
            document.getElementById('message').innerHTML = data;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
