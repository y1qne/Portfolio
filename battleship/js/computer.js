/*jslint browser this */
/*global _, player */

(function (global) {
    "use strict";

    var computer = _.assign({}, player, {
        grid: [],
        tries: [],
        fleet: [],
        game: null,
        a:0,
        play: function () {
            var self = this;
            setTimeout(function () {
                self.game.fire(this, 0, self.a, function (hasSucced) {
                    do {
                        var i = Math.floor(Math.random() * (9 - 0 + 1));
                        var j = Math.floor(Math.random() * (9 - 0 + 1));
                    }while(self.tries[i][j]!=0)
                    self.tries[0][self.a] = hasSucced;
                    self.a++;
                    self.renderTries(self.game.miniGrid);
                });
            }, 2000);
        },
        areShipsOk: function (callback) {
            var col_used = [];
            this.fleet.forEach(ship => {
                do {
                    var i = Math.floor(Math.random() * (9 - 0 + 1));
                }while(col_used.includes(i));
                col_used.push(i);
                var j = 0;
                while (j < ship.life) {
                    this.grid[i][j] = ship.getId();
                    j ++;
                }
            });

            setTimeout(function () {
                callback();
            }, 500);
        },
        renderTries: function (grid) {
            var r=0;
            var c=0;
            var self = this;
            var keep_going = true;
            this.tries.forEach(row => {
                row.forEach(val => {
                    if (val==true){
                        var node = grid.querySelector('.row:nth-child(' + (r + 1) + ') .cell:nth-child(' + (c + 1) + ')');
                        node.style.opacity = '0.5';
                        var ship_name = node.id;
                        for (let i=0; i<4; i++){
                            if (keep_going){
                                if (self.game.players[0].fleet[i].name===ship_name){
                                    self.game.players[0].fleet[i].life--;
                                    console.log(self.game.players[0].fleet[i].life)
                                    keep_going=false;
                                }
                                if (self.game.players[0].fleet[i].life===0){
                                    document.querySelector(`body > div > div.left.column > div.fleet > div.ship.${self.game.players[0].fleet[i].name.toLowerCase()}`).classList.add('sunk');
                                }
                            }
                        }
                    }
                    c++;
                })
                r++;
            });
            keep_going=true;
        },
        setGame : function(ref){
            this.game = ref;
        }
    });

    global.computer = computer;

}(this));