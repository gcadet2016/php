
function windowLoadListener() {
    document.getElementById('btnFermer').style.display = 'none';
    document.getElementById('btnNotation').addEventListener('click', getForm);
    document.getElementById('btnFermer').addEventListener('click', hideForm);
}
window.addEventListener('load', windowLoadListener);

function notesList_eventListener() {
    // Récupérer la valeur de la note sélectionnée
    const selectedValue = this.value;
    // Récupérer l’URL du fichier PHP dans l’attribut action de l’élément form.
    const formElement = document.getElementById('notes-form');
    const url_base = formElement.action;

    // Envoyez au serveur PHP une requête Ajax en envoyant la valeur de la note choisie
    const param = '?note=' + selectedValue;
    const url = url_base + param;
    const headers = new Headers();
    headers.append('Content-Type', 'text/html');
    headers.append('origin','http://localhost');
    fetch(url, {
        method: 'GET',
        mode:"cors",
        headers: headers
    })
    .then(response => response.text())
    .then(data => {
        const responseElement = document.getElementById('response');
        responseElement.textContent = 'La notation américaine pour la note ' + selectedValue + ' est ' + data;
    })
    .catch(err => {console.log(err);});
}

function getForm() {
    if(document.getElementById("notes-form")) {
        console.log('notes-form already loaded');  // for dev and debug purpose - to be deleted
        document.getElementById('notes-form').style.display = 'inline-block';
        document.getElementById('response').style.display = 'inline-block';
    } else {
        console.log('get notes-form');             // for dev and debug purpose - to be deleted
        const headers = new Headers();
        headers.append('Content-Type', 'text/html');
        headers.append('origin','http://localhost');
        const url = "getForm.php";

        fetch(url, {
            method: 'GET',
            mode:"cors",
            headers: headers
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('phpForm').innerHTML = data;
            // Ajouter un event listener 'change' à la liste déroulante
            document.getElementById('notesList').addEventListener('change', notesList_eventListener);
        })
        .catch(err => {console.log(err);});

        // Autre code possible (testé)
        // Créer une requête AJAX
        // const xhr = new XMLHttpRequest();
        // xhr.open('GET', 'getForm.php', true);
        // xhr.onload = function() {
        //     console.log('onLoad running');
        //     if (xhr.status === 200) {
        //         console.log(xhr.responseText);
        //         // Ajouter la liste déroulante au conteneur
        //         document.getElementById('phpForm').innerHTML = xhr.responseText;

        //         // Ajouter un event listener 'change' à la liste déroulante
        //         document.getElementById('notesList').addEventListener('change', notesList_eventListener);
        //     } else {
        //         console.log(xhr.status);
        //     }
        // }
        // xhr.send();

    }
    document.getElementById('btnNotation').style.display = 'none';
    document.getElementById('btnFermer').style.display = 'inline-block';
    
}

function hideForm() {
    document.getElementById('btnNotation').style.display = 'inline-block';
    document.getElementById('btnFermer').style.display = 'none';
    document.getElementById("notes-form").style.display = 'none';
    document.getElementById('response').style.display = 'none';
}