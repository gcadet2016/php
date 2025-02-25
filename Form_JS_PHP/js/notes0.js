const dictionnaire = {
    do: "C",
    ré: "D",
    mi: "E",
    fa: "F",
    sol: "G",
    la: "A",
    si: "B"
};

function windowLoadListener() {
    // JavaScript pour ajouter un formulaire avec une liste déroulante
    const form = document.createElement('form');
    const selectList = document.createElement('select');
    selectList.id = 'notesList';
    const response = document.createElement('p');
    response.id = 'response';

    // Ajouter des options à la liste déroulante
    const option = document.createElement('option');
    selectList.appendChild(option);                     // Première option vide

    for (const clé in dictionnaire) { 
        if (dictionnaire.hasOwnProperty(clé)) {
            const option = document.createElement('option');
            option.value = clé;
            option.textContent = clé;
            selectList.appendChild(option);
        }
    };
    // Ajouter la liste déroulante au formulaire
    form.appendChild(selectList);
    // Ajouter le formulaire au body
    document.body.appendChild(form);
    document.body.appendChild(response);

    // Ajouter un event listener 'change' à la liste déroulante
    selectList.addEventListener('change', function() {
        const responseElement = document.getElementById('response');
        if(this.value) {
            responseElement.textContent = 'La notation américaine pour la note ' + this.value + ' est ' + dictionnaire[this.value];
        } else {
            responseElement.textContent = '';
        }
    });
}
window.addEventListener('load', windowLoadListener);



