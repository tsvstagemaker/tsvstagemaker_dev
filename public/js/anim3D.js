//Movement Animation to happen
const cardEffect = document.querySelector(".card-effect");
const containerEffect = document.querySelector(".container-effect");//Items
const titleEffect = document.querySelector(".title-effect");
const logoEffect = document.querySelector(".logo-ipsc");
const descriptionEffect = document.querySelector(".info-effect h3");
const infoEffectImg = document.querySelector(".info-effect-h1-logo img");
const cardEffectH2H3 = document.querySelector(".card-effect h2 h3");


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
  cardEffectH2H3.style.transform = "translateZ(200px)";
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
  cardEffectH2H3.style.transform = "translateZ(0px)";
});