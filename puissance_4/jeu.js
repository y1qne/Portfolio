export class Jeu{
    constructor(x=7,y=6){
        this.x=x;
        this.y=y;
        this.tab=[];
        this.nb_joueurs=2;
        this.form();
    }
    form(){
        var grid = document.getElementById("jeu");
        var form = document.createElement('form');
        form.setAttribute('id','form');
        var input_col = document.createElement('input');
        input_col.setAttribute('id','col_nb');
        input_col.setAttribute('type','number');
        input_col.setAttribute('value','7');
        var input_row = document.createElement('input');
        input_row.setAttribute('id','row_nb');
        input_row.setAttribute('type','number');
        input_row.setAttribute('value','6');
        var input_alias1 = document.createElement('input');
        input_alias1.setAttribute('id','alias1');
        input_alias1.setAttribute('type','text');
        input_alias1.setAttribute('value','Joueur 1');
        var input_alias2 = document.createElement('input');
        input_alias2.setAttribute('id','alias2');
        input_alias2.setAttribute('type','text');
        input_alias2.setAttribute('value','Joueur 2');
        var input_color1 = document.createElement('input');
        input_color1.setAttribute('id','color1');
        input_color1.setAttribute('type','color');
        input_color1.setAttribute('value','#FF0000');
        var input_color2 = document.createElement('input');
        input_color2.setAttribute('id','color2');
        input_color2.setAttribute('type','color');
        input_color2.setAttribute('value','#FFF700');
        var sub_btn = document.createElement('button');
        var sub_txt = document.createTextNode('START GAME');
        sub_btn.setAttribute('id','sub');
        sub_btn.appendChild(sub_txt);
        var more_btn = document.createElement('button');
        var more_txt = document.createTextNode('ADD PLAYER');
        more_btn.setAttribute('id','more');
        more_btn.appendChild(more_txt);
        form.appendChild(input_alias1);
        form.appendChild(input_color1);
        form.appendChild(input_alias2);
        form.appendChild(input_color2);
        form.appendChild(input_col);
        form.appendChild(input_row);
        form.appendChild(more_btn);
        form.appendChild(sub_btn);
        grid.appendChild(form);

        document.getElementById('more').addEventListener('click',(e) => {
            e.preventDefault();
            this.nb_joueurs++;
            var input_alias = document.createElement('input');
            input_alias.setAttribute('id',`alias${this.nb_joueurs}`);
            input_alias.setAttribute('type','text');
            input_alias.setAttribute('value',`Joueur ${this.nb_joueurs}`);
            var input_color = document.createElement('input');
            input_color.setAttribute('id',`color${this.nb_joueurs}`);
            input_color.setAttribute('type','color');
            form.appendChild(input_alias);
            form.appendChild(input_color);
            grid.appendChild(form);
        });  

        document.getElementById('sub').addEventListener('click',(e) => {
            e.preventDefault();
            for (let a=1 ; a<=this.nb_joueurs ; a++){
                let alias = document.getElementById(`alias${a}`).value;
                let color = document.getElementById(`color${a}`).value;
                this.tab.push([alias,color]);
            }

            var doublon = false;
            for (let c=0 ; c<this.nb_joueurs ; c++){
                let compteur_couleur = 0;
                let compteur_alias = 0;
                let color1 = this.tab[c][1];
                let alias1 = this.tab[c][0];
                for (let d=0 ; d<this.nb_joueurs ; d++){
                    let color2 = this.tab[d][1];
                    let alias2 = this.tab[d][0];
                    if(color1==color2){
                        compteur_couleur++;
                    }
                    if(alias1==alias2){
                        compteur_alias++;
                    }
                    if (compteur_couleur==2 && doublon==false){
                        alert('Vous ne pouvez pas jouer avec la même couleur');
                        doublon = true;
                    }else if (compteur_alias==2 && doublon==false){
                        alert ('Vous ne pouvez pas avoir le même alias');
                        doublon = true;
                    }
                } 
            }
            if(doublon==false){
                this.x = document.getElementById('col_nb').value;
                this.y = document.getElementById('row_nb').value;
                this.form_return();
            }
        });  
    }

    form_return(){
        document.getElementById('form').style.display='none';
        var joueur;
        this.tab.forEach(joueur_info => {
            joueur = new Joueur(joueur_info[0],joueur_info[1]); 
        });
        joueur.display_players(this.tab);

        new Grille(this.x,this.y,this.tab);
    }
}

class Grille{
    constructor(x,y,tab_joueurs){
        this.columns = x;
        this.rows = y;
        this.tab_joueurs = tab_joueurs;
        console.log(this.tab_joueurs);
        this.grid = document.getElementById("jeu");
        this.tableau=[];
        this.color=tab_joueurs[0][1];
        this.joueur_actif=tab_joueurs[0][0];
        this.nb_joueurs=tab_joueurs.length;
        this.id_joueur_actif=0;
        this.nombre_de_pions=0;
        this.last_move_row=0;
        this.last_move_column=0;

        this.display_playzone();
        this.generate_table();
        this.generate_array();
        this.play();
    }

    generate_array(){
        for (let i = 0; i < this.rows; i++) {
            for (let j = 0; j < this.columns; j++) {
                var pion = new Pion(0);
                this.tableau[i][j]=pion;
            }
        }
    }

    display_playzone(){
        const buttons = document.createElement('div');
        buttons.setAttribute('class','playzone');
        for (let i = 0; i < this.columns; i++) {
            const button = document.createElement('div');
            button.setAttribute('class','play_button');
            button.setAttribute('id',`play${i}`);
            buttons.appendChild(button);
        }
        this.grid.appendChild(buttons); 

        for (let i=0 ; i<this.columns ; i++){
            document.getElementById(`play${i}`).style.backgroundColor=this.color;
        }

        const victoire = document.createElement('div');
        victoire.setAttribute('class','victoire');
        victoire.setAttribute('id','victoire');
        victoire.style.display='none';
        this.grid.appendChild(victoire);

        document.getElementById('reset').onclick = () => {
            for (let i=0; i<this.nb_joueurs ; i++){
                localStorage.setItem(this.tab_joueurs[i][0],0);
                document.querySelector(`#joueur${i+1}`).innerText=`${this.tab_joueurs[i][0]} : ${localStorage.getItem(this.tab_joueurs[i][0])} win`;
            }
            this.nouvelle_partie();
        }

        document.getElementById('undo').onclick = () => {
            this.undo_move();
        }
        
    }

    generate_table(){
        const div = document.createElement('div');
        div.setAttribute('class','grid');
        const table = document.createElement("table");
        table.setAttribute('id','table');
        for (let i = 0; i < this.rows; i++) {
            const row = document.createElement("tr");
            this.tableau.push([this.rows-i]);
            for (let j = 0; j < this.columns; j++) {
                const cell = document.createElement("td");
                cell.setAttribute('id',`${this.rows-i-1}${j}`);
                row.appendChild(cell);
            }
        table.appendChild(row);
        }
        div.appendChild(table);
        this.grid.appendChild(div);
    }

    play(){
        document.addEventListener('click',(e) =>{
            // colonne de jeu
            var id_e = e.target.id;
            var column = parseInt(id_e.substr(-1));
            if (id_e.includes("play") && this.tableau[this.rows-1][column].statut==0){


                this.nombre_de_pions++;
                // ligne de jeu
                for (let j = 0; j < this.columns; j++){
                    if(this.tableau[j][column].statut==0){
                        // couleur du pion
                        
                        this.color=this.tab_joueurs[this.id_joueur_actif][1];
                        var status=this.tab_joueurs[this.id_joueur_actif][0];
                        
                        var row = j;
                        this.tableau[row][column].statut=status;  
                        this.last_move_row=row;
                        this.last_move_column=column;

                        this.win_check(column,row);

                        document.getElementById(`joueur${this.id_joueur_actif+1}`).style.borderColor='rgb(45, 45, 45)';

                        // joueur actif
                        if(this.id_joueur_actif<(this.nb_joueurs-1)){
                            this.id_joueur_actif++;
                            this.joueur_actif=this.tab_joueurs[this.id_joueur_actif][0]
                        }else{
                            this.id_joueur_actif=0;
                            this.joueur_actif=this.tab_joueurs[this.id_joueur_actif][0]
                        }
                        
                        document.getElementById(`joueur${this.id_joueur_actif+1}`).style.borderColor='black';

                        break;
                    }
                } 

                // animation
                document.getElementById(id_e).style.backgroundColor=this.color; 

                let move = ((this.rows-row)*100)-10;
                let time = (this.rows-row)*150;
                const pion_anim = [
                    { transform: `translateY(0px)` },
                    { transform: `translateY(${move}px)` },
                    ];

                    const timing = {
                    duration: time,
                    iterations: 1,
                    };
                
                const pion = document.getElementById(id_e);
                
                pion.animate(pion_anim, timing);

                setTimeout(()=>{
                    document.getElementById(`${row}${column}`).style.backgroundColor=this.color; 
                    for (let i=0 ; i<this.columns ; i++){
                        document.getElementById(`play${i}`).style.backgroundColor=this.tab_joueurs[this.id_joueur_actif][1];
                    }
                }, time);
            }
        });
    }

    undo_move(){
        document.getElementById(`${this.last_move_row}${this.last_move_column}`).style.backgroundColor='rgb(45, 45, 45)'; 
        this.tableau[this.last_move_row][this.last_move_column].statut=0;  

        // joueur actif
        document.getElementById(`joueur${this.id_joueur_actif+1}`).style.borderColor='rgb(45, 45, 45)';
        if(this.id_joueur_actif>0){
            this.id_joueur_actif--;
        }else{
            this.id_joueur_actif=this.nb_joueurs-1;
        }
        document.getElementById(`joueur${this.id_joueur_actif+1}`).style.borderColor='black';

    }

    win_check(x,y){
        console.log(this.joueur_actif);
        //horizontal
        var count = 0;
        var i = 0
        while(count<4 && i<this.columns){
            if (this.tableau[y][i].statut==this.joueur_actif){
                count++;
            }else{
                count = 0;
            }
            if (count==4){
                let sens = 'horizontal';
                this.annonce_victoire(this.joueur_actif,sens);
            }
            i++;
        }

        //vertical
        var count = 0;
        var i = 0;
        while(count<4 && i<this.rows){
            if (this.tableau[i][x].statut==this.joueur_actif){
                count++;
            }else{
                count = 0;
            }
            if (count==4){
                let sens = 'vertical';
                this.annonce_victoire(this.joueur_actif,sens);
            }
            i++;
        }

        // diagonale
        var count = 0;
        var X = x;
        var Y = y;
        const diagonale = Math.min(this.columns,this.rows);
        if(Y!=0 && X>0){
            while(Y>0 && X>0){
                X--;
                Y--;
            }    
        }

        while(count<4 && X<this.columns && Y<this.rows){
            if (this.tableau[Y][X].statut==this.joueur_actif){
                count++;
            }else{
                count = 0;
            }
            if (count==4){
                let sens = 'diagonale';
                this.annonce_victoire(this.joueur_actif,sens);
            }
            X++;
            Y++;
        }

        // anti diagonale
        var count = 0;
        var X = x;
        var Y = y;
        if(Y!=0 && X<6){
            while(Y>0 && X<6){
                X++;
                Y--;
            }    
        }

        while(count<4 && X>0 && Y<diagonale){
            if (this.tableau[Y][X].statut==this.joueur_actif){
                count++;
            }else{
                count = 0;
            }
            if (count==4){
                let sens = 'anti-diagonale';
                this.annonce_victoire(this.joueur_actif,sens);
            }
            X--;
            Y++;
        }

        if (this.nombre_de_pions==(this.columns*this.rows)){
            this.grille_pleine();
        }
    }

    annonce_victoire(gagnant,sens){
        document.querySelector('#jeu > div.playzone').style.display='none';
        const playzone = document.querySelector('#jeu > div.victoire');
        playzone.innerHTML = '';
        playzone.style.display = 'flex';
        const victoire = document.createElement('div');
        const winner = document.createTextNode(`${gagnant} a gagné en ${sens} !`);
        victoire.appendChild(winner);

        const nouvelle_partie = document.createElement('button');
        nouvelle_partie.setAttribute('class','nouvelle_partie');
        nouvelle_partie.setAttribute('id','nouvelle_partie');
        const texte = document.createTextNode('NOUVELLE PARTIE');
        nouvelle_partie.appendChild(texte);

        playzone.appendChild(victoire); 
        playzone.appendChild(nouvelle_partie);
        playzone.style.backgroundColor=this.color;
        this.nouvelle_partie(gagnant);

    }

    grille_pleine(){
        document.querySelector('#jeu > div.playzone').innerHTML='';

        const playzone = document.querySelector('#jeu > div.playzone');
        playzone.setAttribute('id','victoire');
        playzone.setAttribute('class','victoire');

        const victoire = document.createElement('div');
        const winner = document.createTextNode(`Match nul : grille pleine`);
        victoire.appendChild(winner);

        const nouvelle_partie = document.createElement('button');
        nouvelle_partie.setAttribute('class','nouvelle_partie');
        const texte = document.createTextNode('NOUVELLE PARTIE');
        nouvelle_partie.appendChild(texte);

        playzone.appendChild(victoire); 
        playzone.appendChild(nouvelle_partie);
        playzone.style.backgroundColor='grey';
        this.nouvelle_partie();
    }

    nouvelle_partie(gagnant='none'){
        if (gagnant!='none'){
            let score = localStorage.getItem(gagnant);
            score++;
            localStorage.setItem(gagnant,score);
        }
        document.addEventListener('click',(e) =>{
            var id_e = e.target.id;
            if (id_e.includes("nouvelle_partie")){
                for (let i = 0; i < this.rows; i++) {
                    for (let j = 0; j < this.columns; j++) {
                        this.tableau[i][j].statut = 0;
                        document.getElementById(`${i}${j}`).style.backgroundColor='rgb(45, 45, 45)';
                    }
                }
                this.nombre_de_pions=0;
                document.querySelector('#victoire').style.display='none';
                document.querySelector('#jeu > div.playzone').style.display='flex';

                for(let i=0 ; i<this.nb_joueurs ; i++){
                    document.querySelector(`#joueur${i+1}`).innerText=`${this.tab_joueurs[i][0]} : ${localStorage.getItem(this.tab_joueurs[i][0])} win`;
                }
            }
        })
    }
}


class Pion{
    #statut;
    constructor(statut){
        this.#statut = statut;
    }   
    get statut() {
        return this.#statut;
    }
    set statut(new_statut) {
        this.#statut = new_statut;
    }  
}

class Joueur{
    constructor(alias,couleur){
        this.alias=alias;
        this.couleur=couleur;
        this.grid = document.getElementById("jeu");
        localStorage.setItem(alias,0);
    }
    display_players(tab_joueurs,i){
        const nav = document.createElement('div');
        nav.setAttribute('id','nav_joueurs');
        var joueur;
        var i = 1;
        const block_joueurs = document.createElement('div');
        block_joueurs.setAttribute('class','block_joueurs');
        tab_joueurs.forEach(joueur_info => {
            joueur = document.createElement('div');
            var score = localStorage.getItem(joueur_info[0].substr(-1));
            if (score == null){
                score = 0;
            }
            joueur.setAttribute('id',`joueur${i}`);
            const content = document.createTextNode(`${joueur_info[0]} : ${score} win`);
            joueur.appendChild(content);
            block_joueurs.appendChild(joueur);
            joueur.style.backgroundColor=joueur_info[1];
            i++;
        });

        nav.appendChild(block_joueurs);

        const block = document.createElement('div');
        block.setAttribute('class','block');
        const reset = document.createElement('button');
        const reset_text = document.createTextNode('RESET SCORE');
        reset.setAttribute('id','reset');
        reset.appendChild(reset_text);
        block.appendChild(reset);

        const undo = document.createElement('button');
        const undo_text = document.createTextNode('UNDO MOVE');
        undo.setAttribute('id','undo');
        undo.appendChild(undo_text);
        block.appendChild(undo);

        nav.appendChild(block);
        this.grid.appendChild(nav);
        document.getElementById('joueur1').style.borderColor='black';
    }
}


