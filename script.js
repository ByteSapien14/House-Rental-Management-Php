function searchHouses() {
    const searchInput = document.getElementById('searchInput').value;
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.querySelector('.card-containers').innerHTML = xhr.responseText;
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.open('GET', 'search.php?address=' + encodeURIComponent(searchInput), true);
    xhr.send();
}
