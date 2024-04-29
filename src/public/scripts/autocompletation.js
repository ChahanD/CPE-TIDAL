document.getElementById('searchInput').addEventListener('input', function() {
    let searchTerm = this.value;
    let pageToFetch = this.dataset.fetchPage;

    if (searchTerm.length >= 2) {
        fetch(`${pageToFetch}?search=` + encodeURIComponent(searchTerm))
            .then(response => response.json())
            .then(data => {
                let suggestionsBox = document.getElementById('suggestionsBox');

                suggestionsBox.innerHTML = data.map(
                    item => `<div class="suggestion-item">${item}</div>`
                ).join('');

                suggestionsBox.classList.add('show');
                suggestionsBox.style.display = 'block';
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
