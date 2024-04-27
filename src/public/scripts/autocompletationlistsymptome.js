document.getElementById('searchInput').addEventListener('input', function() {
    let searchTerm = this.value;

    if (searchTerm.length >= 2) {
        fetch('search_symptome.php?search=' + encodeURIComponent(searchTerm))
            .then(response => response.text())
            .then(data => {
                document.getElementById('suggestionsBox').innerHTML = data;
                document.getElementById('suggestionsBox').classList.add('show');
                document.getElementById('suggestionsBox').style.display = 'block';
            });
    } else {
        document.getElementById('suggestionsBox').classList.remove('show');
        document.getElementById('suggestionsBox').style.display = 'none';
    }
});

document.addEventListener('click', function(event) {
    let isClickInsideSearchInput = event.target === document.getElementById('searchInput') || document.getElementById('suggestionsBox').contains(event.target);

    if (!isClickInsideSearchInput) {
        document.getElementById('suggestionsBox').style.display = 'none';
    }
});

document.getElementById('suggestionsBox').addEventListener('click', function(event) {
    if (event.target.classList.contains('suggestion-item')) {
        document.getElementById('searchInput').value = event.target.textContent;
        document.getElementById('suggestionsBox').style.display = 'none';
    }
});