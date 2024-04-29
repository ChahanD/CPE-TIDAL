document.getElementById('searchInput').addEventListener('input', function() {
    /*
    * This function fetches the search results and displays them in the suggestions box.
    * @param {Event} event The input event (typing in the search input).
    */
    let searchTerm = this.value;

    // Get the URL of the current page from the data-fetch-page attribute of the searchInput element
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
    /*
    * This function hides the suggestions box when the user clicks outside of it.
    * @param {Event} event The click event (outside of the suggestions box).
    */
    let isClickInsideSearchInput = event.target === document.getElementById('searchInput') || document.getElementById('suggestionsBox').contains(event.target);

    if (!isClickInsideSearchInput) {
        document.getElementById('suggestionsBox').style.display = 'none';
    }
});

document.getElementById('suggestionsBox').addEventListener('click', function(event) {
    /*
    * This function fills the search input with the selected suggestion.
    * @param {Event} event The click event (on a suggestion item).
    */
    if (event.target.classList.contains('suggestion-item')) {
        document.getElementById('searchInput').value = event.target.textContent;
        document.getElementById('suggestionsBox').style.display = 'none';
    }
});
