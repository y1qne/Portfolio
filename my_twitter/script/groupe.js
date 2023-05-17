window.onload = () => {
    var select =[];
    select[parseInt(document.getElementById('user').value)] = true;
    console.log(select);
    document.onclick = (e) => {
        var id_e = e.target.id;
        if (id_e.includes('follower')){
            if ( document.getElementById(id_e).style.backgroundColor != 'rgb(255, 33, 113)' ){
                document.getElementById(id_e).style.backgroundColor = '#ff2171'
                document.getElementById(id_e).style.color = '#212121'
                select[id_e.substr(8)]=true;
            }else{
                document.getElementById(id_e).style.color = '#ff2171'
                document.getElementById(id_e).style.backgroundColor = '#212121'
                select[id_e.substr(8)]=false;
            }
        }
    }

    document.getElementById('create_group').onclick = () => {
        var request = new XMLHttpRequest();
        var data = JSON.stringify(select);
        request.open("POST", "./controllers/create_new_group.controller.php", true);
        request.setRequestHeader("Content-Type", "application/json"); // ??
        request.send(data);

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href= 'conversations';
            }
        };
    }
}