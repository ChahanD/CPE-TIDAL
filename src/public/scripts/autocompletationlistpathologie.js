document.getElementById('searchInputPathologie').addEventListener('input', function() {
    let searchTerm = this.value;

    if (searchTerm.length >= 2) {
        fetch('search_pathologie.php?search=' + encodeURIComponent(searchTerm))
            .then(response => response.text())
            .then(data => {
                document.getElementById('suggestionsBoxPathologie').innerHTML = data;
                document.getElementById('suggestionsBoxPathologie').classList.add('show');
                document.getElementById('suggestionsBoxPathologie').style.display = 'block';
            });
    } else {
        document.getElementById('suggestionsBoxPathologie').classList.remove('show');
        document.getElementById('suggestionsBoxPathologie').style.display = 'none';
    }
});

document.addEventListener('click', function(event) {
    let isClickInsideSearchInput = event.target === document.getElementById('searchInputPathologie') || document.getElementById('suggestionsBoxPathologie').contains(event.target);

    if (!isClickInsideSearchInput) {
        document.getElementById('suggestionsBoxPathologie').style.display = 'none';
    }
});

document.getElementById('suggestionsBoxPathologie').addEventListener('click', function(event) {
    if (event.target.classList.contains('suggestion-item')) {
        document.getElementById('searchInputPathologie').value = event.target.textContent;
        document.getElementById('suggestionsBoxPathologie').style.display = 'none';
    }
});

