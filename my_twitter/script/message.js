// window.onload = ()=>{
//     alert('script charge');
// }

document.addEventListener('click',(e) =>{
    const id_e = e.target.id;
    const id_conv = id_e.substr(-1);
    if(id_e.includes("conversation")){
        alert('test');
        // Données à ajouter à $_SESSION
        var newData = id_conv;

        // Envoie une requête POST au serveur avec les données
        $.post('controllers/add_to_session.php', { data: newData }, function(response) {
        // Gestion de la réponse du serveur
        console.log(response);
        });
    }
});