
// $(document).ready(function() { //fonction qui exectute le script        


  const selectbox = document.getElementById("ConditionCourseId");   
        let nbcoup = 0; //Nombre de coup 
        document.getElementById("nbcp").innerText = nbcoup;
        let pts = 0; //Nombre de points
        document.getElementById("point").innerText = pts;
        let pap = 0; //Nombre de cible papier
        document.getElementById("papier").innerText = pap;
        let met = 0; //Nombre de métal 
        document.getElementById("metal").innerText = met;
        let minipap = 0; //Nombre de cible papier
        document.getElementById("minipapier").innerText = minipap;
        let minimet = 0; //Nombre de métal 
        document.getElementById("minimetal").innerText = minimet;
        let plt = 0; //Nombre de métal poper
        document.getElementById("plate").innerText = plt;
        let bob = 0; //Nombre de métal minipoper
        document.getElementById("bobber").innerText = bob;
        let nosh = 0; //Nombre de noshoot 
        document.getElementById("targetNS").innerText = nosh;
        let n = 0;
        let p = 0;
        let decorsvg = document.getElementById("decorsvg");

        const dropzone = document.getElementById("dropzone");

        let draggableSelected = null;
        let scalableSelected = null;
        let resizableSelected = null;
        let keepRatioSelected = true;
        let rotatableSelected = null;
        let warpableSelected = null;

        // const elementremobable = document.querySelector('.removable');
        // let numbercoups = document.getElementById("shortc").innerText = nbcoup;
        
        
        
            $('.draggable').draggable({ //fonction qui rend les elements draggable
            	helper: 'clone',
            	cursor: 'move',
            	scope: "#paper , #metal , #decor",
            	grid: [2, 1],
                // handle: "draggable"              
              })
            
            
            $("#dropzone").droppable({ //fonction qui rend la zone droppable
                //accept: "#objet1, #objet2 , #objet3 , #objet4",           
                scope: "#paper , #metal , #decor",
                drop: function(event, ui) { //fonction qui gere les evenements de drop
                	if (ui.draggable.attr("alt") == "popper") 
                  {
                    n = 1;
                    p = 5;
                    met++;
                  } 
                  else if (ui.draggable.attr("alt") == "minipopper") 
                  {
                    n = 1;
                    p = 5;
                    minimet++;
                  } 
                  else if (ui.draggable.attr("alt") == "plate") 
                  {
                    n = 1;
                    p = 5;
                    plt++;
                  } 
                  else if (ui.draggable.attr("alt") == "target") 
                  {
                    n = 2;
                    p = 10;
                    pap++;
                  } 
                  else if (ui.draggable.attr("alt") == "minitarget") 
                  {
                    n = 2;
                    p = 10;
                    minipap++;
                  } 
                  else if (ui.draggable.attr("alt") == "bobber") 
                  {
                    n = 2;
                    p = 10;
                    bob++;
                  } 
                  else if (ui.draggable.attr("alt") == "targetNS") 
                  {
                    n = 0;
                    p = 0;
                    nosh++;
                  } 
                  else 
                  {
                    n = 0;
                    p = 0;
                  }

                  nbcoup = nbcoup + n;
                  pts = pts + p;

                  document.getElementById("nbcp").innerText = nbcoup; //ligne qui pemettent d'écrire dans le tableau en positif
                  Which(nbcoup);                  
                  function Which(el){
                    removeOption(selectbox);
                    let newOption = new Option();
                    if (el >= 25) {
                     newOption.text='LONG COURSE';
                     newOption.value='3';
                     newOption.id="lonco";
                   }else if(el >= 13){
                     newOption.text='MEDIUM COURSE';
                     newOption.value='2';
                     newOption.id="medco";   
                   }else{
                     newOption.text='SHORT COURSE';
                     newOption.value='1';
                     newOption.id="shortc";      
                   }
                   selectbox.add(newOption);
                 }

                 document.getElementById("point").innerText = pts;
                 document.getElementById("metal").innerText = met;
                 document.getElementById("papier").innerText = pap;
                 document.getElementById("minimetal").innerText = minimet;
                 document.getElementById("minipapier").innerText = minipap;
                 document.getElementById("plate").innerText = plt;
                 document.getElementById("bobber").innerText = bob;
                 document.getElementById("targetNS").innerText = nosh;              

                    let redrag = $(ui.helper).clone().removeClass('draggable') //variable qui enleve la class du l'élément cloné et qui redonne la fontion draggable aux clones
                    redrag.draggable({
                    	containment: 'parent',
                    	cursor: 'move',                                     
                    	grid: [2, 2],
                    	snap: true,
                    	snapTolerance: 5,

                    });


                    //fonction qui permet de mettre l'image au premier avec z-index
                    $(this).append(redrag);
                    $("img").click(function() { 
                    	let maxZindex = 0;
                    	$("img").each(function() {
                    		let z = parseInt($(this).css('z-index'));
                    		if (isNaN(z)) z = 0;
                    		if (z > maxZindex) maxZindex = z;
                    	});
                    //attribuer un z-index supérieur à l'élément cliqué
                    $(this).css('z-index', maxZindex + 1);
                  });

                    //fonction qui permet de mettre le svg au premier avec z-index 
                    $(this).append(redrag);
                    $("svg").click(function() {   
                        // console.log(this)   ;                  
                        let maxZindex = 0;
                        $("svg").each(function() {
                        	let z = parseInt($(this).css('z-index'));
                        	if (isNaN(z)) z = 0;
                        	if (z > maxZindex) maxZindex = z;
                        });
                    //attribuer un z-index supérieur à l'élément cliqué
                    $(this).css('z-index', maxZindex + 1);
                  });
                    
                    
                    if ( $(this).find("img").addClass("removable", "resizables", "rotable") ) { //fonction qui permet d'ajouter une class a l'image
                  };
                    if ( $(this).find("svg").addClass("removable", "resizables", "rotable") ) { //fonction qui permet d'ajouter une class au svg
                  };               



              //   if ( $(this).find("img").attr('id', 'foo123') ) { //fonction qui permet d'ajouter un id a l'image pour la supprimer avec le button reset
              // };




                         // $(this).find("svg").dblclick(function() { //fonction qui supprime un élément svg de la zone droppable par l'action double click
                         // 	$(this).remove();                        
                         // });
                         // 
                       }                         

                     });


// const elementToRotate = document.querySelector('.rotable');
// // elementToRotate.addEventListener('click', (e) => {
// //   console.log("ok");
// // })

// $(".rotable").dblclick(function() { 
//   var degrees = 0;                  
//   degrees += 10;
//   $(".rotable").css("transform","rotate("+degrees+"deg)");
// });                   


            $("#reset").on("click", function() { // fonction du boutton reset pour supprmer tout les elements clone draggés dans la zone possedant la classe removable 
            	$('.removable').remove();
            	nbcoup = 0;
            	pts = 0;
            	met = 0;
            	minimet = 0;
            	plt = 0;
            	pap = 0;
            	minipap = 0;
            	bob = 0;
            	nosh = 0;
                document.getElementById("nbcp").innerText = nbcoup; //ligne qui pemettent d'écrire dans le tableau a zéro
                document.getElementById("point").innerText = pts;
                document.getElementById("metal").innerText = met;
                document.getElementById("papier").innerText = pap;
                document.getElementById("minimetal").innerText = minimet;
                document.getElementById("minipapier").innerText = minipap;
                document.getElementById("plate").innerText = plt;
                document.getElementById("bobber").innerText = bob;
                document.getElementById("targetNS").innerText = nosh;
                // exit();
              }); 

// resize eement draggable
// 
// // bugfix for http://dev.jquery.com/ticket/1749
// if ( (/absolute/).test( el.css("position") ) ) {
//     el.css({ position: "absolute", top: el.css("top"), left: el.css("left") });
// } else if (el.is(".ui-draggable")) {
//     el.css({ position: "absolute", top: iniPos.top, left: iniPos.left });
// }

// $( function() {
//   $( ".elementsDraggable" ).resizable({
//     // animate: true,
//     // containment: "#dropzone",
//     // helper: "ui-resizable-helper",
//     // aspectRatio: true,
//     // autoHide: true
//   });

//   // Getter
// var aspectRatio = $( ".selector" ).resizable( "option", "aspectRatio" ); 
// // Setter
// $( "#paper", "#metal" ).resizable( "option", "aspectRatio", true );

// } );

// $( function() {
//     $( ".elementsDraggable" ).selectable();
//   } );



    $("#elements").accordion({ //Fonction pour la liste déroulante des cibles et accessoires
    	collapsible: true,
    	heightStyle: "content"

    });

    $( "#accordion-resizer" ).resizable({
    	minHeight: 300,
    	minWidth: 200,
    	resize: function() {
    		$( "#elements," ).accordion( "refresh" );
    	}
    });



            // change COULEURS PANNEAU
            function changeColor(){
              let color = document.getElementById('colorInputColor').value;               
              $("svg rect").each(function() {
                $(".panneau1").css("fill", color);
              });
            }

            

            // loader ouverture page    
            function loaderspiner(){
            	$('.loader-container').addClass('hidden');
            }
            setTimeout(loaderspiner, 3000);


            function removeOption(el) {
              while (el.options.length > 0) {
                el.remove(0);
              }
            }

//fonction de calcul de l'angle actuel des images
// function calculateAngle(elementId) {
//     var element = document.getElementById(elementId);
//     var tr = (window.getComputedStyle(element, null)).getPropertyValue("transform"),
//         values = tr.split('(')[1],
//         values = values.split(')')[0],
//         values = values.split(','),
//         a = values[0],
//         b = values[1],
//         c = values[2],
//         d = values[3],
//         radians = Math.atan2(b, a);
//     if (radians < 0) {
//         radians += (2 * Math.PI);
//     }
//     return Math.round(radians * (180 / Math.PI));
// }

 // function pour attribuer le click droit a rotation
  // document.oncontextmenu = function() {return false;};
  // $('.draggable').mousedown(function(e){ 
  //   if( e.button == 2 ) { 
  //     var selectedId = $(this).attr('id');
  //     var currentDegree = calculateAngle(selectedId);
  //     var newDegree = parseInt(currentDegree) + parseInt(10);
  //     $(this).css({"transform":"rotate(" + newDegree + "deg)"});
  //   } 
  //   return true; 
  // });



  /*********************************************** Context Menu Function Only ********************************/
  (function() {

    "use strict";


    function clickInsideElement( e, className ) {
      var el = e.srcElement || e.target;
      if ( el.classList.contains(className) ) {
        return el;
      } else {
        while ( el = el.parentNode ) {
          if ( el.classList && el.classList.contains(className) ) {
            return el;
          }
        }
      }
      return false;
    }

    function getPosition(e) {
      var posx = 0, posy = 0;
      if (!e) var e = window.event;
      if (e.pageX || e.pageY) {
        posx = e.pageX;
        posy = e.pageY;
      } else if (e.clientX || e.clientY) {
        posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
        posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
      }
      return {
        x: posx,
        y: posy
      }
    }

  // Your Menu Class Name
  let taskItemClassName = "removable";
  let contextMenuClassName = "context-menu",
  contextMenuItemClassName = "context-menu__item",
  contextMenuLinkClassName = "context-menu__link", 
  contextMenuActive = "context-menu--active";

  let taskItemInContext, 
  clickCoords, 
  clickCoordsX, 
  clickCoordsY, menu = document.querySelector("#context-menu"), 
  menuItems = menu.querySelectorAll(".context-menu__item");

  let menuState = 0, 
  menuWidth, 
  menuHeight, 
  menuPosition, 
  menuPositionX, 
  menuPositionY, 
  windowWidth, 
  windowHeight;

  function initMenuFunction() {
    contextListener();
    clickListener();
    keyupListener();
    resizeListener();
  }

  /**
   * Listens for contextmenu events.
   */
   function contextListener() {
    document.addEventListener( "contextmenu", function(e) {
      taskItemInContext = clickInsideElement( e, taskItemClassName );
      // console.log(taskItemInContext);

      if ( taskItemInContext ) {
        e.preventDefault();
        toggleMenuOn();
        positionMenu(e);
      } else {
        taskItemInContext = null;
        toggleMenuOff();
      }
    });
  }

  /**
   * Listens for click events.
   */
   function clickListener() {
    document.addEventListener( "click", function(e) {
      var clickeElIsLink = clickInsideElement( e, contextMenuLinkClassName );

      if ( clickeElIsLink ) {
        e.preventDefault();
        menuItemListener( clickeElIsLink );
      } else {
        var button = e.which || e.button;
        if ( button === 1 ) {
          toggleMenuOff();
        }
      }
    });
  }

  /**
   * Listens for keyup events.
   */
   function keyupListener() {
    window.onkeyup = function(e) {
      if ( e.keyCode === 27 ) {
        toggleMenuOff();
      }      
    }
  }

  /**
   * Window resize event listener
   */
   function resizeListener() {
    window.onresize = function(e) {
      toggleMenuOff();
    };
  }

  /**
   * Turns the custom context menu on.
   */
   function toggleMenuOn() {
    if ( menuState !== 1 ) {
      menuState = 1;
      menu.classList.add( contextMenuActive );
    }
  }

  /**
   * Turns the custom context menu off.
   */
   function toggleMenuOff() {
    if ( menuState !== 0 ) {
      menuState = 0;
      menu.classList.remove( contextMenuActive );
    }
  }

  function positionMenu(e) {
    clickCoords = getPosition(e);
    clickCoordsX = clickCoords.x;
    clickCoordsY = clickCoords.y;
    menuWidth = menu.offsetWidth + 4;
    menuHeight = menu.offsetHeight + 4;

    windowWidth = window.innerWidth;
    windowHeight = window.innerHeight;

    if ( (windowWidth - clickCoordsX) < menuWidth ) {
      menu.style.left = (windowWidth - menuWidth)-0 + "px";
    } else {
      menu.style.left = clickCoordsX-0 + "px";
    }

    // menu.style.top = clickCoordsY + "px";

    if ( Math.abs(windowHeight - clickCoordsY) < menuHeight ) {
      menu.style.top = (windowHeight - menuHeight)-0 + "px";
    } else {
      menu.style.top = clickCoordsY-0 + "px";
    }
  }

  function movableStart(mouseTarget){
    // let mouseTarget = document.querySelector('.movableItem');
  const moveable = new Moveable(dropzone, {
    target: mouseTarget,
    container: dropzone,
    draggable: draggableSelected,
    scalable: scalableSelected,
    resizable: resizableSelected,
    keepRatio: keepRatioSelected,
    rotatable: rotatableSelected,
    warpable:warpableSelected
  })
  .on("drag", ({ target, transform }) => {
    target.style.transform = transform
  })
  .on("scale", ({ target, transform }) => {
    target.style.transform = transform
  })
  .on("rotate", ({ target, transform }) => {
    target.style.transform = transform
  })
  .on("resize", ({ target, width, height }) => {
    target.style.width = width + "px";
    target.style.height = height  + "px";
  })
  .on("warp", ({ target, transform }) => {
    target.style.transform = transform;  
  })
}

function movableStop(){
 let targetElements = document.querySelectorAll('.ui-draggable'); 
 targetElements.forEach(targetElements =>{  
  let divRemove = document.querySelectorAll('.moveable-control-box');
  // console.log(divRemove);
  divRemove.forEach(divRemove =>{
    divRemove.remove();
  })
  
})
}



  function menuItemListener( link ) {
    let actionItem = link.getAttribute("data-action");   
      // delete Item
      if (actionItem == "deleteItem") {
        let menuSelectedItem = taskItemInContext.getAttribute("alt");
    // console.log(menuSelectedItem);    
    taskItemInContext.remove();
    console.log('Clicked Action Name: '+actionItem);
    console.log('Clicked Item Name: '+menuSelectedItem);

    if (menuSelectedItem == "popper") 
    {
      n = 1;
      p = 5;
      met--;
    } 
    else if (menuSelectedItem == "minipopper") 
    {
      n = 1;
      p = 5;
      minimet--;
    } 
    else if (menuSelectedItem == "plate") 
    {
      n = 1;
      p = 5;
      plt--;
    } 
    else if (menuSelectedItem == "target") 
    {
      n = 2;
      p = 10;
      pap--;
    } 
    else if (menuSelectedItem == "minitarget") 
    {
      n = 2;
      p = 10;
      minipap--;
    } 
    else if (menuSelectedItem == "bobber") 
    {
      n = 2;
      p = 10;
      bob--;
    } 
    else if (menuSelectedItem == "targetNS") 
    {
      n = 0;
      p = 0;
      nosh--;
    } 
    else {
      n = 0;
      p = 0;
    }

    nbcoup = nbcoup - n;
    pts = pts - p;
        document.getElementById("nbcp").innerText = nbcoup; //ligne qui pemettent d'écrire dans le tableau en négatif
        document.getElementById("point").innerText = pts;
        document.getElementById("metal").innerText = met;
        document.getElementById("papier").innerText = pap;
        document.getElementById("minimetal").innerText = minimet;
        document.getElementById("minipapier").innerText = minipap;
        document.getElementById("plate").innerText = plt;
        document.getElementById("bobber").innerText = bob;
        document.getElementById("targetNS").innerText = nosh;
        toggleMenuOff();
        movableStop();
      }

      // Rotate with css
    //   if(actionItem == 'rotateItem'){        
    //    let menuSelectedItem = taskItemInContext.getAttribute("class", "svg");  
    //    taskItemInContext.classList.toggle('selectedItem');
    //    if (taskItemInContext.classList.contains("selectedItem")) {
    //      let degrees = 10;
    //      taskItemInContext.addEventListener("click", (e) =>{
    //       let targetElement = e.target || e.srcElement;     
    //       targetElement.style.transform = "rotate("+degrees+"deg)";
    //       degrees +=10;
    //       console.log('Clicked Action Name: '+actionItem);
    //       console.log('Clicked Item Name: '+menuSelectedItem);
    //       toggleMenuOff();
    //              // console.log(degrees);             
    //            })
    //    }else{
    //     toggleMenuOff();
    //   }

    // }
    if (actionItem == 'resizeItem') {
     let menuSelectedItem = taskItemInContext.getAttribute("class", "svg");
     taskItemInContext.classList.toggle('movableItem');
     if (taskItemInContext.classList.contains("movableItem")) {

      let mouseTarget = document.querySelector('.movableItem');
      resizableSelected = true;
      rotatableSelected = false;
      warpableSelected = false;
      movableStart(mouseTarget);

      toggleMenuOff();      
    }else{
     toggleMenuOff();
     movableStop()
     // taskItemInContext.classList.toggle("movableItem");   
   }
    }

    if (actionItem == 'rotateItem') {
     let menuSelectedItem = taskItemInContext.getAttribute("class", "svg");
     taskItemInContext.classList.toggle('movableItem');
     if (taskItemInContext.classList.contains("movableItem")) {

      let mouseTarget = document.querySelector('.movableItem');
      rotatableSelected = true;
      resizableSelected = false;
      warpableSelected = false;
      movableStart(mouseTarget);

      toggleMenuOff();      
    }else{
     toggleMenuOff();
     movableStop()
     // taskItemInContext.classList.toggle("movableItem");   
   }
 } 

 if (actionItem == 'warpableItem') {
     let menuSelectedItem = taskItemInContext.getAttribute("class", "svg");
     taskItemInContext.classList.toggle('movableItem');
     if (taskItemInContext.classList.contains("movableItem")) {

      let mouseTarget = document.querySelector('.movableItem');
      warpableSelected = true;
      rotatableSelected = false;
      resizableSelected = false;
      movableStart(mouseTarget);

      toggleMenuOff();      
    }else{
     toggleMenuOff();
     movableStop()
     // taskItemInContext.classList.toggle("movableItem");   
   }
 } 

 if(actionItem && actionItem.length > 7){
  console.log('Clicked Item Name: '+actionItem);
}
toggleMenuOff();
}
initMenuFunction();

})();




// function movableStart(){
//   const moveable = new Moveable(dropzone, {
//     target: mouseTarget,
//     container: dropzone,
//     draggable: draggableSelected,
//     scalable: scalableSelected,
//     resizable: resizableSelected,
//     keepRatio: keepRatioSelected,
//     rotatable: rotatableSelected,
//     warpable:warpableSelected
//   })
//   .on("drag", ({ target, transform }) => {
//     target.style.transform = transform
//   })
//   .on("scale", ({ target, transform }) => {
//     target.style.transform = transform
//   })
//   .on("rotate", ({ target, transform }) => {
//     target.style.transform = transform
//   })
//   .on("resize", ({ target, width, height }) => {
//     target.style.width = width + "px";
//     target.style.height = height  + "px";
//   })
//   .on("warp", ({ target, transform }) => {
//     target.style.transform = transform;  
//   })
// }

// function movableStop(){
//  let targetElements = document.querySelectorAll('.ui-draggable'); 
//  targetElements.forEach(targetElements =>{  
//   let divRemove = document.querySelectorAll('.moveable-control-box');
//   // console.log(divRemove);
//   divRemove.forEach(divRemove =>{
//     divRemove.remove();
//   })
// })
// }



// const dropzone = document.getElementById('dropzone');
// let target = dropzone.querySelectorAll('.removable');
// target.forEach(target => {
//   target.addEventListener('mouseenter', (e) =>{
//     let targetElement = e.target || e.srcElement;
//     console.log(targetElement);
//     if (targetElement.classList.contains('removable')) {
//       targetElement.classList.toggle('movableItem');
//       console.log(targetElement);
//       const moveable = new Moveable(dropzone, {
//         target: document.querySelectorAll(".removable"),
//         origin: false,
//         dragArea: true,
//         // draggable: true,
//         rotatable: true,
//         scalable: true,
//         pinchable: true,
//         keepRatio: true,
//         snappable: true,
//         edge: true,
//         throttleDrag: 1,
//         throttleRotate: 0.2,
//         throttleResize: 1,
//       })
//       // .on("drag", ({ target, transform }) => {
//       //   target.style.transform = transform
//       // })
//       .on("scale", ({ target, transform }) => {
//         target.style.transform = transform
//       }).on("rotate", ({ target, transform }) => {
//         target.style.transform = transform
//       }).on("resize", ({ target, transform }) => {
//         target.style.transform = transform
//       })

//       window.addEventListener("resize", () => {
//         moveable.updateRect();
//       });
//     }
//   })
// })
// 
