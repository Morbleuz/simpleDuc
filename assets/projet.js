var inputNewTache = document.getElementById('tache');
const idProjet = document.getElementById('nomProjet').getAttribute('data-id');
const idUser = document.getElementById('nomProjet').getAttribute('data-id-user')
const listeDo = document.getElementById('rigth');
const listeToDo = document.getElementById('left');
const url = 'http://s3-4440.nuage-peda.fr';

//Permet de savoir si le script est en cours d'utilisation.
var isInExec = false;
//Ajout des event
inputNewTache.addEventListener('change', inputAddTache);
addEventsListeners();

function addEventsListeners() {
    let items = document.getElementsByClassName('item');
    for (t of items) {
        t.addEventListener('click', updateTacheState);
    }
    let trash = document.getElementsByClassName('fa-trash');
    console.log(trash);
    for (t of trash) {
        t.addEventListener('click', deleteTache);
    }
}

async function deleteTache() {
    console.log();
    await deleteTacheInDb(this.getAttribute('data-id'));
    updateListeTache();
}

async function deleteTacheInDb(idTache) {
    let response = await fetch(url + '/simpleDuc/public/api/taches/' + idTache, {
        method: "DELETE"
    });

}

async function updateTacheInDb(idTache, estFaite, nomTache) {
    console.log('start');
    let response = await fetch(url + '/simpleDuc/public/api/taches/' + idTache, {
        method: "PATCH", // *GET, POST, PUT, DELETE, etc.
        headers: {
            "Content-Type": " application/merge-patch+json",
            "accept": "application/ld+json",
        },
        body: JSON.stringify({
            "nomTache": nomTache,
            "estFaite": estFaite,
            "projet": "/simpleDuc/public/api/projets/" + idProjet,
            "developpeur": "/simpleDuc/public/api/developpeurs/" + idUser
        }),

    });
}

async function updateTacheState() {
    if (this.getAttribute('data-done') == 'false') {
        await updateTacheInDb(this.getAttribute('data-id'), true);
        this.setAttribute('data-done', 'true');
    } else {
        await updateTacheInDb(this.getAttribute('data-id'), false);
        this.setAttribute('data-done', 'false');
    }
    await updateListeTache();

}
async function updateListeTache() {
    if (!isInExec) {
        isInExec = true;
        //Clear des listes
        while (listeDo.lastChild) {
            listeDo.removeChild(listeDo.lastChild)
        }
        while (listeToDo.lastChild) {
            listeToDo.removeChild(listeToDo.lastChild)
        }
        let newListeTache = await recupTaches();
        newListeTache = newListeTache['taches'];
        for (tache of newListeTache) {
            let div = document.createElement('div');
            div.setAttribute('class', 'tache');

            let p = document.createElement('p');
            p.setAttribute('data-id', tache['id']);
            p.setAttribute('data-done', tache['estFaite']);
            p.setAttribute('data-nomTache', tache['nomTache']);
            p.setAttribute('class', 'item');


            let i = document.createElement('i');
            i.setAttribute('class', 'fa fa-trash');
            i.setAttribute('data-id', tache['id']);

            p.innerHTML = tache['nomTache'];
            div.innerHTML = p.outerHTML + i.outerHTML;

            if (tache['estFaite'] == true) {
                listeDo.appendChild(div);
            } else {
                listeToDo.appendChild(div);

            }
        }
        isInExec = false;
        addEventsListeners();
    }
    console.log('programme en cours dexec');
}

///
async function inputAddTache() {
    if (this.value == " " || this.value == "" || this.value == null) {
        console.log('empty');
        return;
    }
    await addNewTache(this.value, false, idProjet, idUser);
    await updateListeTache();
    this.value = null;
}

//Récupération de la liste de taches
async function recupTaches() {
    let response = await fetch(url + '/simpleDuc/public/api/projets/' + idProjet, {
        method: "GET", // *GET, POST, PUT, DELETE, etc.
        headers: {},

    });

    return response.json();
}

/*
async function getToken() {
    let response = await fetch('http://s3-4440.nuage-peda.fr/simpleDuc/public/api/authentication_token', {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        headers: {
            "Content-Type": "application/ld+json",
            "accept": "application/ld+json",
        },
        body: JSON.stringify({
            "email": localStorage.getItem('email'),
            "password": localStorage.getItem('mdp'),
        }),
    });
    return response.json;
}
*/
async function addNewTache(nomDeTache, isDone, idProjet, idDeveloppeur) {
    let response = await fetch(url + '/simpleDuc/public/api/taches', {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        headers: {
            "Content-Type": "application/ld+json",
            "accept": "application/ld+json",

        },
        body: JSON.stringify({
            "nomTache": nomDeTache,
            "estFaite": isDone,
            "projet": "/simpleDuc/public/api/projets/" + idProjet,
            "developpeur": "/simpleDuc/public/api/developpeurs/" + idDeveloppeur
        }),
    });
    console.log(response.json);

    return response.json();
}