// sympto.js
document.getElementById('filter-form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Récupérer les valeurs des champs du formulaire
    var pathology = document.getElementById('pathology').value;
    var meridians = document.getElementById('meridians').value;
    var symptomSearch = document.getElementById('symptom-search').value;

    // Filtrer les données en fonction des valeurs récupérées
    // Note: Vous devez avoir une structure de données pour les pathologies et les symptômes
    var filteredData = data.filter(function(item) {
        return item.pathology === pathology && item.meridians === meridians && item.symptoms.includes(symptomSearch);
    });

    // Mettre à jour le tableau avec les données filtrées
    var tableBody = document.getElementById('symptoms-table').getElementsByTagName('tbody')[0];
    tableBody.innerHTML = '';
    filteredData.forEach(function(item) {
        var row = tableBody.insertRow();
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = item.pathology;
        cell2.innerHTML = item.symptoms.join(', ');
    });
});