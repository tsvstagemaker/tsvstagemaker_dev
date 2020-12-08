const img = document.querySelector('.headerAnim');
const bgsombre = document.querySelector('.connect');
const titreAnim = document.querySelector('.titreAnim');
const helloAnim = document.querySelector('.helloAnim');
const readyAnim = document.querySelector('.readyAnim');
const standbyAnim = document.querySelector('.standbyAnim');
const registererAnim = document.querySelector('.registererAnim');
const alert = document.querySelector('.alert');
// const tireur = document.querySelector('#tireur');

const TL1 = new TimelineMax({pause: false});

TL1
// .staggerFromTo(img,2,{opacity:0, y: -900})
// .staggerFromTo(bgsombre,2,{opacity:0, y: 500}, '-=1')

.from(img,2,{opacity:0, y: -900})

.from(bgsombre,1,{opacity:0, y: 600}, '-=1')
// .from(bgsombre,2,{scale:0}, '-=1')

.from(titreAnim,1,{opacity:0, y: -400}, '-=1')

.from(helloAnim,1,{opacity:0, x: 100})

.from(readyAnim,1.2,{opacity:0, x: -100})


.from(standbyAnim,1.3,{opacity:0, x: -100})

// .from(registererAnim,1.4,{scale:0});
.to(registererAnim, {scale:1, duration: 0.4, stagger: 0.1, ease: "back.out(2)"});


const TL2 = new TimelineMax({pause: false});

TL2
.from(alert,1,{opacity:0, y: -100});

// Draggable.create("#tireur");

// Draggable.create("#tireur", {
//    type: "rotation",
//    inertia: true
// });

Draggable.create("#tireur", {
    // type:"y",
    bounds: document.getElementById("container"),
    inertia: true,
    onClick: function() {
        console.log("clicked");
    },
    onDragEnd: function() {
        console.log("drag ended");
    }
});


var ctrl = new ScrollMagic.Controller();

// Create scenes in jQuery each() loop
$("section").each(function(i) {
  var inner = $(this).find(".inner");
  var outer = $(this).find(".outer");
  var tl = new TimelineMax();
  
  tl.from(outer, 0.25, { scaleX: 0 });
  tl.from(inner, 0.65, { yPercent: 100, ease: Back.easeOut });
  
  new ScrollMagic.Scene({
    triggerElement: this,
    triggerHook: 0.60
  })
    .setTween(tl)
    // .addIndicators({
    //   colorTrigger: "black",
    //   colorStart: "black",
    //   colorEnd: "black",
    //   indent: 40
    // })
    .addTo(ctrl);
});