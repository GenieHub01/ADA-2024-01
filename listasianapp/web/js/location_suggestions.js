function fetchSuggestions(type) {
    const input = document.getElementById(type).value;
    const suggestionsDiv = document.getElementById('suggestions');
    if (input.length < 3) return;

    fetch(`/api/getSuggestions?type=${type}&query=${input}`)
        .then(response => response.json())
        .then(data => {
            suggestionsDiv.innerHTML = '';
            data.forEach(item => {
                const option = document.createElement('div');
                option.textContent = item.display_name;
                option.onclick = () => {
                    document.getElementById(type).value = item.display_name;
                    suggestionsDiv.style.display = 'none';
                };
                suggestionsDiv.appendChild(option);
            });
            suggestionsDiv.style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
}
