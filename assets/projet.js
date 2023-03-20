alert('h');
var inputNewTache = document.getElementById('tache');

//Ajout des event

inputNewTache.addEventListener('change', showInput)

function showInput() {
    console.log(this.value);
}
/*
{
    "nomTache": "string",
    "estFaite": false,
    "projet": "/simpleDuc/public/api/projets/2",
    "developpeur": "/simpleDuc/public/api/developpeurs/28"
}
*/