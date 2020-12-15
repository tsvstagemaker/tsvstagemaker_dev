
$(document).ready(function() { //fonction qui exectute le script        
            //console.log(document);


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
        let decorsvg = document.getElementById("decorsvg")
        
        
        
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
                	if (ui.draggable.attr("alt") == "popper") {
                		n = 1;
                		p = 5;
                		met++;
                	} else if (ui.draggable.attr("alt") == "minipopper") {
                		n = 1;
                		p = 5;
                		minimet++;
                	} else if (ui.draggable.attr("alt") == "plate") {
                		n = 1;
                		p = 5;
                		plt++;
                	} else if (ui.draggable.attr("alt") == "target") {
                		n = 2;
                		p = 10;
                		pap++;
                	} else if (ui.draggable.attr("alt") == "minitarget") {
                		n = 2;
                		p = 10;
                		minipap++;
                	} else if (ui.draggable.attr("alt") == "bobber") {
                		n = 2;
                		p = 10;
                		bob++;
                	} else if (ui.draggable.attr("alt") == "targetNS") {
                		n = 0;
                		p = 0;
                		nosh++;
                	} else {
                		n = 0;
                		p = 0;
                	}

                	nbcoup = nbcoup + n;
                	pts = pts + p;

                    document.getElementById("nbcp").innerText = nbcoup; //ligne qui pemettent d'écrire dans le tableau en positif
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
                    
                    
                    if ( $(this).find("img").addClass("removable") ) { //fonction qui permet d'ajouter une class a l'image pour la supprimer avec le button reset
                };


                      if ( $(this).find("svg").addClass("removable") ) { //fonction qui permet d'ajouter une class a le svg pour la supprimer avec le button reset
                  };

                         $(this).find("svg").dblclick(function() { //fonction qui supprime un élément svg de la zone droppable par l'action double click
                         	$(this).remove();                        
                         });



                    $(this).find("img").dblclick(function() { //fonction qui supprime un élément image de la zone droppable par l'action double click
                    	$(this).remove();
                    	if (ui.draggable.attr("alt") == "popper") {
                    		n = 1;
                    		p = 5;
                    		met--;
                    	} else if (ui.draggable.attr("alt") == "minipopper") {
                    		n = 1;
                    		p = 5;
                    		minimet--;
                    	} else if (ui.draggable.attr("alt") == "plate") {
                    		n = 1;
                    		p = 5;
                    		plt--;
                    	} else if (ui.draggable.attr("alt") == "target") {
                    		n = 2;
                    		p = 10;
                    		pap--;
                    	} else if (ui.draggable.attr("alt") == "minitarget") {
                    		n = 2;
                    		p = 10;
                    		minipap--;
                    	} else if (ui.draggable.attr("alt") == "bobber") {
                    		n = 2;
                    		p = 10;
                    		bob--;
                    	} else if (ui.draggable.attr("alt") == "targetNS") {
                    		n = 0;
                    		p = 0;
                    		nosh--;
                    	} else {
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
                        exit();
                    });
                }
            });

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
                exit();
            });
            
            
            



        });

    $("#elements").accordion({ //Fonction pour la liste déroulante des cibles et accessoires
    	collapsible: true,
    	heightStyle: "fill"

    });

    $( "#accordion-resizer" ).resizable({
    	minHeight: 200,
    	minWidth: 200,
    	resize: function() {
    		$( "#elements," ).accordion( "refresh" );
    	}
    }); 


            // script pour telecharger le pdf direct sur pc
            function savPDF(){
            	window.scrollTo(0, 0);
            	html2canvas(document.getElementById("datastage"),{scale: 2}).then(function(canvas){
            		let doc = new jsPDF();
            		// let doc = new jsPDF('p', 'mm', [400, 480]);
                // doc.setFontSize(5);
                // doc.text(40, 25, "text")
                doc.addImage(canvas.toDataURL("image/jpeg", 0.9), 'JPEG', 5, 5, 202, 290);//'JPEG', 15(Gauche), 10 (Haut), 180 (Droite), 280 (Bas)
                
                doc.save("stage.pdf");  

            });
            };  


            // change COULEURS PANNEAU
            // 
            function changeColor(){
                let color = document.getElementById('colorInputColor').value;               
                $("svg rect").each(function() {
                    $(".panneau1").css("fill", color);
                });
            }

            

            // $("#btn-orange").on("click", function () {
            // 	$(".panneau1").css({ fill: "#FE9301" });
            // });

            // $("#btn-vert").on("click", function () {
            // 	$(".panneau1").css({ fill: "#839B6D" });
            // });

            // $("#btn-vert2").on("click", function () {
            // 	$(".panneau1").css({ fill: "#3D963E" });
            // });

            // $("#btn-gris").on("click", function () {
            // 	$(".panneau1").css({ fill: "#C0BCBC" });
            // });

            // $("#btn-bleu").on("click", function () {
            // 	$(".panneau1").css({ fill: "#2CA8F5" });
            // });

            // $("#btn-reset").on("click", function () {
            // 	$(".panneau1").css({ fill: "#FF8000" });
            // });


            //rotation elements
            let degrees = 0;
            $(".elementRotate").click(function () {
            	degrees += 10;
            	$(this).css("transform", "rotate(" + degrees + "deg)");
            });


            // loader ouverture page    
            function loaderspiner(){
            	$('.loader-container').addClass('hidden');
            }
            setTimeout(loaderspiner, 3000);          



            // canvas
            // const canvas = document.getElementById('canvas');
            // const ctx = canvas.getContext('2d');            

            // canvas.width = 100;
            // canvas.height = 75;

            // ctx.beginPath();

            // ctx.fillStyle = "#e2ae87";
            // ctx.strokeStyle = '#3f63a4';
            // ctx.strokeRect(5,5,90,60);
            // ctx.fillRect(5,5,90,60);

            // ctx.moveTo(85,50);
            // ctx.lineTo(100,70);

            // ctx.moveTo(15,50);
            // ctx.lineTo(0,70);

            // ctx.stroke();