var storedMarker = Array();
function createXmlRequest(){
	var xmlHttp;
	try{
		xmlHttp = new XMLHttpRequest();
	}catch(e){
		xmlVersions = new Array("MSXML2.XMLHTTP.6.0",
								"MSXML2.XMLHTTP.5.0",
								"MSXML2.XMLHTTP.4.0",
								"MSXML2.XMLHTTP.3.0",
								"MSXML2.XMLHTTP",
								"Microsoft.XMLHTTP");
		for(var i=0; i < xmlVersions.length && !xmlHttp; i++){
			try{
				xmlHttp = new ActiveXObject(xmlVersions[i]);
			}catch(e){}
		}
	}
	if(!xmlHttp){
		alert("Error creating XMLHttpRequestObject");
	} else {
		return xmlHttp;
	}
}

var xmlHttp = createXmlRequest();

function displaybrews(){
	if(xmlHttp.readyState == 4){
		if(xmlHttp.status == 200 || xmlHttp.status == 304){
			try{
				var root = xmlHttp.responseXML.documentElement;
				var brews = root.getElementsByTagName("brews");
				var mapOptions ={
					zoom: 12,
					zoomControlOptions: {
						position: google.maps.ControlPosition.LEFT_BOTTOM,
					},
					streetViewControlOptions: {
						position: google.maps.ControlPosition.LEFT_BOTTOM,
					},
					center: new google.maps.LatLng(39.737567, -104.984718),
					scrollwheel: false,
					navigationControl: false,
					mapTypeControl: false,
					panControl: false,
			};
	
			map = new google.maps.Map(document.getElementById('gmap'), mapOptions);
			/*map.setZoom(12);*/
			
			var infoBubble = new InfoBubble({
						map: map,
						backgroundColor: '#ffffff',
						borderRadius: 4,
						maxWidth: 260,
						minWidth: 260,
						maxHeight: 45,
						minHeight: 45,
						arrowSize: 10,
						borderWidth: 2,
						borderColor: '#e95404',
						disableAutoPan: false,
						arrowPosition: 50,
						backgroundClassName: 'phoney',
						arrowStyle: 1
				});
				
				/*var infoWindow = new google.maps.InfoWindow;*/
				
				for(var i=0; i < brews.length; i++){
					var brew = brews[i].getAttribute("brew");
					var address = brews[i].getAttribute("address");
					var id = brews[i].getAttribute("id");
					var point = new google.maps.LatLng(
						parseFloat(brews[i].getAttribute("lat")),
						parseFloat(brews[i].getAttribute("lng"))
					);
					var html = "<p class='jsBrew'><a href='#' id="+id+">"+brew+"</a></p>";
					html += "<p class='jsAddress'>"+address+"</p>";
					
					var marker = new google.maps.Marker({
						map: map,
						position: point,
						icon: './images/beer-mug.png'
					});
					
					/*brewList.push(brew);*/
					bindMarker(marker, map, infoBubble, html);
					appendListing(html);
					storedMarker[id] = marker;
					if(i == brews.length-1){
						$('body').click();
					}
		      }
			  
			}catch(e){
			  alert("Error recieving server response");
		  }
		}
	 }
   }

function init(){
	$('#listing').empty();
	/*RESIZE MAP*/
	var height = document.documentElement.clientHeight;
	var width = document.documentElement.clientWidth;
	var map = document.getElementById('gmap');
	if(width > 800){
		map.style.height = height - 205 + "px";
	}else{
		map.style.height = height - 165 + "px";
	} 
	
	/*RESIZE LISTING*/
	var height = document.documentElement.clientHeight;
	var listing = document.getElementById('listing');
	listing.style.height = height - 225 + "px";
	
	
	/*var infoWindow = new google.maps.InfoWindow;*/
	if(xmlHttp){
		xmlHttp.open("GET", "beer_db.php", true);
		xmlHttp.onreadystatechange = displaybrews;
		xmlHttp.send(null);
	}
	
	
   var docWidth = document.documentElement.clientWidth;
   if(docWidth <= 800){
		$("#listing").animate({right:-300});
   }

}

function bindMarker(marker, map, infoBubble, html){
		google.maps.event.addListener(marker, 'click', function() {
			infoBubble.close()
			infoBubble.setContent(html)
			infoBubble.open(map, marker)
		});
}

function appendListing(html){
	$('#listing').append(html);
	
	this.onclick = function(){
		$('#listing a').click(function(event){
			var pop_up = this.getAttribute("id");
			google.maps.event.trigger(storedMarker[pop_up], "click");
			event.stopPropagation();
		});
	}
}

google.maps.event.addDomListener(window, 'load', init);
google.maps.event.addDomListener(window, 'resize', init);