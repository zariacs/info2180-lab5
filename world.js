let buttons = document.querySelectorAll('button');
let result = document.getElementById('result');

buttons.forEach(btn =>
    btn.onclick = (event) => {
        event.preventDefault();
        let search = document.getElementById("country").value;
        console.log(btn.id);
        if (btn.id == 'lookup-country') {
            var params = {
                country: search,
                lookup: 'country'
            };
        } else if (btn.id == 'lookup-cities') {
            var params = {
                country: search,
                lookup: 'cities'
            };
        }
        console.log(params);
        let url = 'http://localhost/info2180-lab5/world.php?' + new URLSearchParams(params);

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
)
