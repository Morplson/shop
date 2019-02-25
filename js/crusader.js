/**
 * String.format() port from Python
 * @params format to
 */  
String.prototype.format = function () {
	var a = this;
	for (var k in arguments) {
		a = a.replace(new RegExp("\\{" + k + "\\}", 'g'), arguments[k]);
	}
	return a
}

class Color{
	constructor(){
		
		this.red;
		this.green;
		this.blue;
		this.hue;
		this.saturation;
		this.light;
		this.alpha;

		switch(arguments[].lenght()){
			default:
				console.error("NO or WRONG arguments given");
				this = null;
				break;
			case 1:
				// Objekt oder Name oder strig
			case 3:
				// rgb, hsl
			case 4:
				// rgba, hsla
		}
	}

	hsl(h,s,l){

	}

	rgb(r,g,b){

	}

	hsla(h,s,l,a){

	}

	rgba(r,g,b,a){

	}
}