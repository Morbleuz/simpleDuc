var inputNewTache = document.getElementById('tache');
const idProjet = document.getElementById('nomProjet').getAttribute('data-id');

//Ajout des event
inputNewTache.addEventListener('change', showInput)

function showInput() {
    console.log(this.value);
    if (this.value == " " || this.value == "" || this.value == null) {
        console.log('empty');
        return;
    }
    addNewTache(this.value, false, idProjet, );
    this.value = null;
}
getToken();
console.log(getToken);

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
addNewTache('test', true, 2, 28);

async function addNewTache(nomDeTache, isDone, idProjet, idDeveloppeur) {
    let response = await fetch('http://s3-4440.nuage-peda.fr/simpleDuc/public/api/taches', {
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

function updateTache(isDone, idTache) {

}
/*
{
    "nomTache": "string",
    "estFaite": false,
    "projet": "/simpleDuc/public/api/projets/2",
    "developpeur": "/simpleDuc/public/api/developpeurs/28"
}
*/