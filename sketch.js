let j1, j2, b1, b2, valider1 = false, valider2 = false, j1wl = false, j2wl = false, rectj1, rectj2, id1, id2;


function setup() {


    var cnv = createCanvas(840,520);
    cnv.parent('calculateur');
    strokeWeight(3);
    stroke(0);

    textFont('Monospace');
    textSize(35);

    text('Joueur 1',85,50);
    j1 = createInput();
    j1.position(85,75);
    j1.size(150);

    text('Joueur 2',505,50);
    j2 = createInput();
    j2.position(505,75);
    j2.size(150);

    b1 = createButton('Valider');
    b1.position(j1.x + j1.width, j1.y);
    b1.mousePressed(() => {
        id1 = int(j1.value());
        valideJoueur(1000,1)
    });
    b1.size(100);

    b2 = createButton('Valider');
    b2.position(j2.x + j2.width, j2.y);
    b2.mousePressed(() => {
        id2 = int(j2.value());
        valideJoueur(976,2);
    });
    b2.size(100);

    j1.parent('calculateur');
    j2.parent('calculateur');
    b1.parent('calculateur');
    b2.parent('calculateur');

    textSize(26);
    text('Elo initial',85,150);
    text('Elo initial',505,150);

}

function draw() {

    if (j1wl == true && valider1 && valider2){

        fill('green');
        noStroke();
        rect(85,250,250,80);
        fill('white');
        textSize(42);
        textAlign(CENTER);
        text('WIN',210,305);
    }

    if (j2wl == true && valider1 && valider2){

        fill('green');
        noStroke();
        rect(505,250,250,80);
        fill('white');
        textSize(42);
        textAlign(CENTER);
        text('WIN',630,305);


    }

    if (j1wl == false && valider1 && valider2){

        fill('red');
        noStroke();
        rect(85,250,250,80);
        fill('white');
        textSize(42);
        textAlign(CENTER);
        text('LOSE',210,305);
    }

    if (j2wl == false && valider1 && valider2){

        fill('red');
        noStroke();
        rect(505,250,250,80);
        fill('white');
        textSize(42);
        textAlign(CENTER);
        text('LOSE',630,305);

    }

    if ((j2wl && j1wl) == false && j1wl != j2wl){

    bval = createButton('Calculer elo');
    bval.position(width/2 - 70, 350);
    bval.mousePressed(() => {calculeElo(id1,id2)});
    bval.size(140);
    bval.parent('calculateur');


    }

}

function valideJoueur(elo,pos){

    let posJ;

    if (pos == 1) {
        posJ = 85;
        valider1 = true;
    }
    else {
        posJ = 505;
        valider2 = true;
    }

    text(elo,posJ,200);

}

function mousePressed(){

    if(mouseX >= 85 && mouseX <= 335 && mouseY >= 250 && mouseY <= 330){

        if(j1wl == true){j1wl = false;}
        else{j1wl = true;}

    }

    if(mouseX >= 505 && mouseX <= 755 && mouseY >= 250 && mouseY <= 330){

        if(j2wl == true){j2wl = false;}
        else{j2wl = true;}

    }


}

function calculeElo(id1,id2){

    
    p1w = 1/(1 + pow(10,(id2 - id1)/400));
    p2w = 1/(1 + pow(10,(id1 - id2)/400));

    
    if(j1wl == true && j2wl == false){
        
        id1 += 32*(1 - p1w);
        id2 += 32*(0 - p2w);
   
    }
 
    else if(j2wl == true && j1wl == false){
        
        id1 += 32*(0 - p1w);
        id2 += 32*(1 - p2w);
    
    }
    
    id1 = round(id1);
    id2 = round(id2);
 
    textSize(26);
    fill(0);
    text(id1,85,450);
    text(id2,505,450);

}  
