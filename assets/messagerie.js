let sendEmailBtn = document.getElementById("sendEmail");
let listeEmployer = document.getElementsByClassName("list-group");
let formSend = document.getElementById("formSend");
let inputReceiverID = document.getElementById("ReceiverID");
let ReceiverReception = document.getElementById("ReceiverReception");
let SenderReception = document.getElementById("senderReception");
let messagerecuBtn = document.getElementById("messagerecu");
let messageEnvoyerBtn = document.getElementById("messageenvoyer");
formSend.style.display = "none";
let idEmployerReceiver = 0;
let caseS = null;
SenderReception.style.display = "none";
messagerecuBtn.addEventListener("click", AfficherReceiverRecept, false);
messageEnvoyerBtn.addEventListener("click", AfficherSenderRecept, false);


for (const employer of listeEmployer[0].children) {
    employer.addEventListener("click", selectEmployer, false);
}
sendEmailBtn.addEventListener("click", sendEmail, false)

function sendEmail() {
    inputReceiverID.value = idEmployerReceiver;
}

function AfficherSenderRecept() {
    SenderReception.style.display = "block";
    ReceiverReception.style.display = "none";
    messageEnvoyerBtn.classList.add("active");
    messagerecuBtn.classList.remove("active")
}

function AfficherReceiverRecept() {
    SenderReception.style.display = "none";
    ReceiverReception.style.display = "block";
    messageEnvoyerBtn.classList.remove("active");
    messagerecuBtn.classList.add("active")
}

function selectEmployer() {
    if (caseS != null) {
        caseS.classList.remove("bg-dark", "text-white");
        formSend.style.display = "none";
    }

    if (caseS == this) {
        caseS.classList.remove("bg-dark", "text-white");
        caseS = null;
    } else {
        this.classList.add("bg-dark", "text-white");
        caseS = this;
        console.log("selectionner")
        formSend.style.display = "block";
        idEmployerReceiver = this.getAttribute("data-id");
    }


    console.log(idEmployerReceiver)
}