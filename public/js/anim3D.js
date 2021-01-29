// Anim 3D 1

//Movement Animation to happen
const cardEffect = document.querySelector(".card-effect");
const containerEffect = document.querySelector(".container-effect");//Items
const titleEffect = document.querySelector(".title-effect");
const logoEffect = document.querySelector(".logo-ipsc");
const descriptionEffect = document.querySelector(".info-effect h3");
const infoEffectImg = document.querySelector(".info-effect-h1-logo img");
const cardEffectH2 = document.querySelector(".card-effect h2");
const cardEffectH3 = document.querySelector(".card-effect h3");



//Moving Animation Event
containerEffect.addEventListener("mousemove", (e) => {
  let xAxis = (window.innerWidth / 2 - e.pageX) / 25;
  let yAxis = (window.innerHeight / 2 - e.pageY) / 25;
  cardEffect.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
});
//Animate In
containerEffect.addEventListener("mouseenter", (e) => {
  cardEffect.style.transition = "none";
  //Popout
  titleEffect.style.transform = "translateZ(-150px)";
  logoEffect.style.transform = "translateZ(200px) rotateZ(1deg)";
  descriptionEffect.style.transform = "translateZ(200px)"; 
  infoEffectImg.style.transform = "translateZ(200px)";
  cardEffectH2.style.transform = "translateZ(200px)";
  cardEffectH3.style.transform = "translateZ(200px)";
});
//Animate Out
containerEffect.addEventListener("mouseleave", (e) => {
  cardEffect.style.transition = "all 0.5s ease";
  cardEffect.style.transform = `rotateY(0deg) rotateX(0deg)`;
  //Popback
  titleEffect.style.transform = "translateZ(0px)";
  logoEffect.style.transform = "translateZ(0px) rotateZ(0deg)";
  descriptionEffect.style.transform = "translateZ(0px)";
  infoEffectImg.style.transform = "translateZ(0px)";
  cardEffectH2.style.transform = "translateZ(0px)";
  cardEffectH3.style.transform = "translateZ(0px)";
});



// Anim 3D 2

const headerAnim = document.querySelector(".headerAnim");
const divEffect = document.querySelector(".div-effect");
const imgShooter = document.querySelector(".img-shooter");
const ipscTarget = document.querySelector(".ipsc-target");





//Moving Animation Event
headerAnim.addEventListener("mousemove", (e) => {
  let xAxis = (window.innerWidth / 2 - e.pageX) / 25;
  let yAxis = (window.innerHeight / 2 - e.pageY) / 25;
  divEffect.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
});
//Animate In
headerAnim.addEventListener("mouseenter", (e) => {
  divEffect.style.transition = "none";
  //Popout
  
  imgShooter.style.transform = "translateZ(500px) translateY(50px) translateX(50px) rotateZ(6deg)";
  ipscTarget.style.transform = "translateZ(-500px) translateY(200px) translateX(200px)";
 
});
//Animate Out
headerAnim.addEventListener("mouseleave", (e) => {
  divEffect.style.transition = "all 0.5s ease";
  divEffect.style.transform = `rotateY(0deg) rotateX(0deg)`;
  //Popback
  
  imgShooter.style.transform = "translateZ(0px) rotateZ(0deg)";
  ipscTarget.style.transform = "translateZ(0px) rotateZ(0deg)";
  
});

