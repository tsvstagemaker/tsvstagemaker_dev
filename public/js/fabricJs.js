// const dropzone = document.getElementById("dropzone");
// let clientWidth = document.getElementById('dropzone').clientWidth;
// let clientHeight = document.getElementById('dropzone').clientHeight;
// let dropzoneWidth = clientWidth;
// let dropzoneHeight = clientHeight -29;

// console.log(clientWidth, clientHeight);
// console.log(dropzoneWidth, dropzoneHeight);

// const initCanvas = (id) => {
// 	return new fabric.Canvas(id, {
// 		width: dropzoneWidth,
// 		height: dropzoneHeight,
// 		selection: false,
// 	});

// }

// const setBackground = (url, canvas) =>{
// 	fabric.Image.fromURL(url, (img) =>{
// 		canvas.backgroundImage = img
// 		canvas.renderAll()

// 	})

// }
// const toggleMode = (mode) =>{
// 	if (mode === modes.pan) {
// 		if (currentMode === modes.pan) {
// 			currentMode = ''
// 		}else{
// 			currentMode = modes.pan
// 			canvas.isDrawingMode = false
// 			canvas.renderAll()
// 		}
// 	}else if (mode === modes.drawing) {
// 		if (currentMode === modes.drawing) {
// 			currentMode = ''
// 			canvas.isDrawingMode = false
// 			canvas.renderAll()
// 		}else{
// 			currentMode = modes.drawing
// 			canvas.freeDrawingBrush.color = color
// 			canvas.isDrawingMode = true
// 			canvas.renderAll()
// 		}
// 	}
// }

// const setPanEvents = (canvas) => {
// 	// mouse:over
// 	canvas.on('mouse:move', (event) => {
// 		if (mousePressed && currentMode === modes.pan) {
// 			canvas.setCursor('grab')
// 			canvas.renderAll()
// 			const mEvent = event.e;
// 			const delta = new fabric.Point(mEvent.movementX, mEvent.movementY)
// 			canvas.relativePan(delta)
// 		} 
// 	})

// 	// Keep track of mousemouse:down/up
// 	canvas.on('mouse:down', (event) => {
// 		mousePressed = true;
// 		if (currentMode === modes.pan) {
// 			canvas.setCursor('grab')
// 			canvas.renderAll()
// 		}

// 	})

// 	canvas.on('mouse:up', (event) => {
// 		mousePressed = false;
// 		canvas.setCursor('defzult')
// 		canvas.renderAll()
// 	})

// }

// const setColorListener = () => {
// 	const picker = document.getElementById('colorPicker')
// 	picker.addEventListener('change', (event) => {
// 			// console.log(event.target.value)
// 			color = event.target.value
// 			// console.log(color)
// 			canvas.freeDrawingBrush.color = color		
// 			canvas.renderAll()
// 		})
// }

// const clearCanvas = (canvas, state) => {
// 	state.val = canvas.toSVG()
// 	canvas.getObjects().forEach((o) => {
// 		if (o !== canvas.backgroundImage) {
// 			canvas.remove(o)
// 			console.log(o)
// 		}		
// 	})
// }

// const restoreCanvas = (canvas, state, bgUrl) => {
// 		if (state.val) {
// 			fabric.loadSVGFromString(state.val, objects => {
// 				objects = objects.filter(o => o['xlink:href'] !== bgUrl)
// 				canvas.add(...objects)
// 				canvas.requestRenderAll()
// 			})
// 		}		
	
// }

// const createRect = (canvas) =>{
// 	// console.log('rect')
// 	const canvCenter = canvas.getCenter()
// 	const rect = new fabric.Rect({
// 		width: 100,
// 		height: 100,
// 		// fill: "green",
// 		fill: canvas.freeDrawingBrush.color = color,
// 		stroke: '#000',
// 		// stroke: canvas.freeDrawingBrush.color = color,
// 		strokeWidth: 1,
// 		left: canvCenter.left,
// 		top: -50,
// 		originX: 'center',
// 		originY: 'center',
// 		cornerColor: '#17a2b8',
// 		objectCaching: false
// 	})
// 	canvas.add(rect)
// 	canvas.renderAll();
// 	rect.animate('top', canvCenter.top,{
// 		onChange: canvas.renderAll.bind(canvas)
// 	});
// 	rect.on('selected', () => {
// 		rect.fill = canvas.freeDrawingBrush.color = color
// 		// rect.set('fill', canvas.freeDrawingBrush.color = color)		
// 		canvas.requestRenderAll()
// 	})

// 	// rect.on('deselected', () => {
// 	// 	rect.fill = ''
// 	// 	canvas.renderAll()

// 	// })
// }

// const createCircle = (canvas) =>{
// 	// console.log('circle')
// 	const canvCenter = canvas.getCenter()
// 	const circle = new fabric.Circle({
// 		radius: 50,
// 		// fill: "orange",
// 		fill: canvas.freeDrawingBrush.color = color,
// 		left: canvCenter.left,
// 		top: -50,		
// 		originX: 'center',
// 		originY: 'center',
// 		cornerColor: '#17a2b8',
// 		objectCaching: false,

// 		// lockScalingX: true,
// 		// lockScalingY: true,
// 	})
// 	canvas.add(circle)
// 	canvas.renderAll();
// 	circle.animate('top', canvas.height -50,{
// 		onChange: canvas.renderAll.bind(canvas),
// 		onComplete: () => {
// 			circle.animate('top', canvCenter.top, {
// 			onChange: canvas.renderAll.bind(canvas),
// 			easing: fabric.util.ease.easeOutBounce,
// 			duration: 500
// 		})
// 		}
// 	});
// 	circle.on('selected', () => {
// 		circle.fill = canvas.freeDrawingBrush.color = color
// 		canvas.requestRenderAll()
// 	})

// }

// const groupObjects = (canvas, group, shouldGroup) =>{
// 	if (shouldGroup) {
// 		const objects = canvas.getObjects()
// 		group.val = new fabric.Group(objects, {cornerColor: '#17a2b8'})
// 		clearCanvas(canvas, svgState)
// 		canvas.add(group.val)
// 		canvas.requestRenderAll()
// 	}else{
// 		group.val.destroy()
// 		let oldGroup = group.val.getObjects()
// 		clearCanvas(canvas, svgState)
// 		canvas.add(...oldGroup)
// 		canvas.val = null
// 		canvas.requestRenderAll()
// 	}
// }


// const imagAdded = (e) => {
// 	console.log(e)
// 	const inputElem = document.getElementById('myImage');
// 	const file = inputElem.files[0];
// 	reader.readAsDataURL(file)
	
// }

// const canvas = initCanvas('canvas')
// const svgState = {}
// let mousePressed = false
// let color = '#000000'
// const group = {}
// const bgUrl = ''
// // const ungroup = {}

// let currentMode;

// const modes = {
// 	pan: 'pan',
// 	drawing: 'drawing'
// }
// const reader =  new FileReader()


// // setBackground('./contact-mobile.png', canvas);
// setBackground(bgUrl, canvas);
// setPanEvents(canvas);

// const inputFile = document.getElementById('myImage');
// inputFile.addEventListener('change', imagAdded)

// reader.addEventListener("load", () =>{
// 	fabric.Image.fromURL(reader.result, img=>{
// 		canvas.add(img)
// 		canvas.requestRenderAll()
// 	})
// })

// window.addEventListener('resize', resizeCanvas, false);
// function resizeCanvas() {
//     canvas.setHeight(jQuery('#image').height());
//     canvas.setWidth(jQuery('#image').width());
//     canvas.renderAll();
// }
// resizeCanvas();