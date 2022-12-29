let btn = document.getElementById('lookup');
let result = document.getElementById('result');

btn.onclick = (event) => {
    event.preventDefault();
    let search = document.getElementById("country").value;
    let url = 'http://localhost/info2180-lab5/world.php?' + new URLSearchParams({ country: search });

    fetch(url)
        .then(response => response.text())
        .then(data => {
            // Add country data to result div
            result.innerHTML = data;
        })
        .catch(error => {
            console.log(error);
        })
}

