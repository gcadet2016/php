(function () {

    
    // ---------------------------------------- //
    function windowLoadListener() {
        const notes = ['do', 'ré', 'mi', 'fa', 'sol', 'la', 'si'];
        // Remplir le liste déroulante
        let selectList = document.getElementById("notesList");
        notes.forEach(item => {
            const option = document.createElement('option');
            option.value = item;
            option.textContent = item;
            selectList.appendChild(option);
        });

        selectList.addEventListener('change', function() {
            // Récupérer la valeur de la note sélectionnée
            const selectedValue = this.value;
            // Récupérer l’URL du fichier PHP dans l’attribut action de l’élément form.
            const formElement = document.getElementById('notes-form');
            const url_base = formElement.action;
            console.log(url_base);

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
                console.log(data);
                const responseElement = document.getElementById('response');
                responseElement.textContent = 'La notation américaine pour la note ' + selectedValue + ' est ' + data;
            })
            .catch(err => {console.log(err);});
        });
    }
    window.addEventListener('load', windowLoadListener);
})();

