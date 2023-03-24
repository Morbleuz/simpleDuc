let ListebtnP = document.getElementsByClassName("btnP");
let modal = document.getElementsByClassName("modal");
let inputHiddenFormulaireCandidat = document.getElementById("annonceID");
for (const btnP of ListebtnP) {
    btnP.addEventListener("click", LinkModalToForm, false)
}


function LinkModalToForm() {
    let idAnnonce = this.getAttribute("data-id");

    modal[0].setAttribute("id", "modal" + idAnnonce)
    inputHiddenFormulaireCandidat.value = idAnnonce;
    console.log(idAnnonce);
    console.log(modal[0]);
}