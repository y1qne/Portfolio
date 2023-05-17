window.onload = function(){
    let droite = document.getElementById("droite");
    let gauche = document.getElementById("gauche");
    let fleches = document.getElementById("fleches");
    let image = document.getElementById("images");
    let bande = document.getElementById("bande");
    image.src = "carousel/6.jpg";
    var i=6;
    var j=1;
    var k=1;
    document.querySelector(`#contenaire > div.dots > div:nth-child(${j})`).style.backgroundPosition="0px -60px";
    
    interval = this.setInterval(slideright,5000);

    droite.onclick = function(){
        slideright(); 
    }
    
    function slideright(){
        if(i==11){
            i=6;
            j=1;
        }
        else{
            i++;
            j++;
        }
        image.src = `carousel/${i}.jpg`;
        document.querySelector(`#contenaire > div.dots > div:nth-child(${j})`).style.backgroundPosition="0px -60px";
        document.querySelector(`#contenaire > div.dots > div:nth-child(${k})`).style.backgroundPosition="0px 0px";
        k=j;
        clearInterval(interval);
        interval = this.setInterval(slideright,5000);
    }

    gauche.onclick = function slideleft(){
        if(i==6){
            i=11;
            j=6;
        }
        else{
            i--;
            j--;
        }
        image.src = `carousel/${i}.jpg`;
        document.querySelector(`#contenaire > div.dots > div:nth-child(${j})`).style.backgroundPosition="0px -60px";
        document.querySelector(`#contenaire > div.dots > div:nth-child(${k})`).style.backgroundPosition="0px 0px";
        k=j;
        clearInterval(interval);
        interval = this.setInterval(slideright,5000);
    }

    this.document.getElementsByClassName("dot")[0].onclick = function(){
        image.src = "carousel/6.jpg";
        document.querySelector(`#contenaire > div.dots > div:nth-child(${k})`).style.backgroundPosition="0px 0px";
        document.querySelector('#contenaire > div.dots > div:nth-child(1)').style.backgroundPosition="0px -60px";
        i=6;
        k=1;
        j=1;
        clearInterval(interval);
        interval = this.setInterval(slideright,5000);
    }
    this.document.getElementsByClassName("dot")[1].onclick = function(){
        image.src = "carousel/7.jpg";
        document.querySelector(`#contenaire > div.dots > div:nth-child(${k})`).style.backgroundPosition="0px 0px";
        document.querySelector('#contenaire > div.dots > div:nth-child(2)').style.backgroundPosition="0px -60px";
        i=7;
        k=2;
        j=2;
        clearInterval(interval);
        interval = this.setInterval(slideright,5000);
    }
    this.document.getElementsByClassName("dot")[2].onclick = function(){
        image.src = "carousel/8.jpg";
        document.querySelector(`#contenaire > div.dots > div:nth-child(${k})`).style.backgroundPosition="0px 0px";
        document.querySelector('#contenaire > div.dots > div:nth-child(3)').style.backgroundPosition="0px -60px";
        i=8;
        k=3;
        j=3;
        clearInterval(interval);
        interval = this.setInterval(slideright,5000);
    }   
    this.document.getElementsByClassName("dot")[3].onclick = function(){
        image.src = "carousel/9.jpg";
        document.querySelector(`#contenaire > div.dots > div:nth-child(${k})`).style.backgroundPosition="0px 0px";
        document.querySelector('#contenaire > div.dots > div:nth-child(4)').style.backgroundPosition="0px -60px";
        i=9;
        k=4;
        j=4;
        clearInterval(interval);
        interval = this.setInterval(slideright,5000);
    }
    this.document.getElementsByClassName("dot")[4].onclick = function(){
        image.src = "carousel/10.jpg";
        document.querySelector(`#contenaire > div.dots > div:nth-child(${k})`).style.backgroundPosition="0px 0px";
        document.querySelector('#contenaire > div.dots > div:nth-child(5)').style.backgroundPosition="0px -60px";
        i=10;
        k=5;
        j=5;
        clearInterval(interval);
        interval = this.setInterval(slideright,5000);
    }
    this.document.getElementsByClassName("dot")[5].onclick = function(){
        image.src = "carousel/11.jpg";
        document.querySelector(`#contenaire > div.dots > div:nth-child(${k})`).style.backgroundPosition="0px 0px";
        document.querySelector('#contenaire > div.dots > div:nth-child(6)').style.backgroundPosition="0px -60px";
        i=11;
        k=6;
        j=6;
        clearInterval(interval);
        interval = this.setInterval(slideright,5000);
    }

    //carousel drapeaux
    var l=0
    var drapeau = document.querySelector("#france > img")
    var pays = document.querySelector("#france > p")
    var drapeaux_liste = ["drapeaux/3.jpg","drapeaux/4.jpg","drapeaux/5.jpg"]
    var pays_liste = ["France","Brazil","Algeria"]
    drapeau.onclick = function(){
        if(window.innerWidth<615){
            if(l<2){
                l++
            }else{
                l=0
            }
            drapeau.src = drapeaux_liste[l]
            pays.innerText = pays_liste[l]
        }
    } 

    // responsive arrows and text
    window.addEventListener('resize',move_arrows)
    function move_arrows(){
        if(window.innerWidth>847){
            var width_bande = image.clientWidth
            bande.style.width=`${width_bande}px`
            var top_arrows = -image.clientHeight/2-42
            fleches.style.top=`${top_arrows}px`
        }
        else{
            var top_arrows = -image.clientHeight/2 -25
            fleches.style.top=`${top_arrows}px`
        }
    }
    move_arrows()
}