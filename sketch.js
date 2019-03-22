function setup() {
    createCanvas(829,523);
}

function draw() {


    if (mouseIsPressed) {
        background(color(mouseX,mouseY,125));
        fill(color(125,mouseY,mouseX));
    } 
    
    else {
        background(color(mouseY,125,mouseX));
        fill(color(mouseX,mouseY,125));
    }

    ellipse(mouseX,mouseY,30,30);
}
