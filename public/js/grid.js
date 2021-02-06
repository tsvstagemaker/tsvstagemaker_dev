$(document).ready(function(){
let clientWidth = document.getElementById('dropzone').clientWidth;
let clientHeight = document.getElementById('dropzone').clientHeight;
// let dropzoneWidth = clientWidth;
// let dropzoneHeight = clientHeight -29;


let canvas = document.getElementById("canvas");
canvas.width = clientWidth;;
canvas.height = clientHeight -29;
let ctx = canvas.getContext("2d");
let cw = canvas.width;
let ch = canvas.height;

let $amount = $("#amount");

$("#slider-horizontal").slider({
    // orientation: "horizontal",
    range: "min",
    min: 0,
    max: 100,
    value: 0,
    slide: function (event, ui) {
        let value = ui.value;
        $amount.val(value);
        drawGrid(value);
    }
});

$amount.val($("#slider-horizontal").slider("value"));
drawGrid(0);


function drawGrid(lineCount) {
    let xSpan = cw / lineCount;
    let ySpan = cw / lineCount * 1.15;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    if (lineCount / 2 === parseInt(lineCount / 2)) {
        ctx.translate(.5, .5);
    }
    ctx.beginPath();
    for (let i = 0; i < lineCount; i++) {
        let x = (i + 1) * xSpan;
        let y = (i + 1) * ySpan;
        ctx.moveTo(x, 0);
        ctx.lineTo(x, ch);
        ctx.moveTo(0, y);
        ctx.lineTo(ch, y);
    }
    ctx.lineWidth = 0.50;
    ctx.stroke();
    ctx.restore();
}

})