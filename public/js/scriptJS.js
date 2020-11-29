
$(document).ready(function() { //fonction qui exectute le script		
			//console.log(document);


		var nbcoup = 0; //Nombre de coup 
		document.getElementById("nbcp").innerText = nbcoup;
		var pts = 0; //Nombre de points
		document.getElementById("point").innerText = pts;
		var pap = 0; //Nombre de cible papier
		document.getElementById("papier").innerText = pap;
		var met = 0; //Nombre de métal 
		document.getElementById("metal").innerText = met;
		var minipap = 0; //Nombre de cible papier
		document.getElementById("minipapier").innerText = minipap;
		var minimet = 0; //Nombre de métal 
		document.getElementById("minimetal").innerText = minimet;
		var plt = 0; //Nombre de métal poper
		document.getElementById("plate").innerText = plt;
		var bob = 0; //Nombre de métal minipoper
		document.getElementById("bobber").innerText = bob;
		var nosh = 0; //Nombre de noshoot 
		document.getElementById("targetNS").innerText = nosh;
		var n = 0;
		var p = 0;
		
		
		
			$('.ui-widget-content').draggable({ //fonction qui rend les elements draggable
				helper: 'clone',
				cursor: 'move',
				scope: "#paper , #metal , #decor",
				grid: [2, 1],
				// handle: "ui-widget-content"				
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
					
					var redrag = $(ui.helper).clone().removeClass('ui-widget-content') //variable qui enleve la class du l'élément cloné et qui redonne la fontion draggable aux clones
					redrag.draggable({
						containment: 'parent',
						cursor: 'move',										
						grid: [2, 2],
						snap: true,
						snapTolerance: 5,
						
					});
					
					$(this).append(redrag);
					$("img").click(function() { //fonction qui permet de rendre draggable des elements inseré dans la zone dropzone							
						var maxZindex = 0;
						$("img").each(function() {
							var z = parseInt($(this).css('z-index'));
							if (isNaN(z)) z = 0;
							if (z > maxZindex) maxZindex = z;
						});
					//assign a z-index greater than the current max to the clicked item
					$(this).css('z-index', maxZindex + 1);
				});
					
					
					if ( $(this).find('img').addClass("ui-removable") ) { //fonction qui permet d'ajouter une class	pour le supprimer
				};

			

			
					$(this).find('img').dblclick(function() { //fonction qui enleve un élément de la zone droppable par l'action double click
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

			$("#reset").on("click", function() { // fonction du boutton reset pour enlever tout les element clone draggés dans la zone 
				$('.ui-removable').remove();
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
			
			
			
				$("#elements").accordion({ //Fonction pour la liste déroulante des cible et accessoires
					collapsible: true,
					heightStyle: "fill"
					
				});
				
				$( "#accordion-resizer" ).resizable({
					minHeight: 140,
					minWidth: 200,
					resize: function() {
						$( "#elements," ).accordion( "refresh" );
					}
				});			
				
				
			});