/**
 * @author Phuc Vuong
 */
$(document).ready(function(){
	  var options = {
      zoom: 14,
      center: new google.maps.LatLng(10.93938,108.101186),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	  streetViewControl: false ,
	   navigationControl: true, 
	  navigationControlOptions: { 
		style: google.maps.NavigationControlStyle.SMALL 
	  } 
    };

    // Creating the map  
    var map = new google.maps.Map(document.getElementById('map'), options);
    
    // Adding a marker to the map
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(10.93938,108.101186),
      map: map,
      title: 'Click me',
      icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/blue/blank.png'
    });
    
    
    Cufon.replace('.contact-title-form');
    Cufon.replace('#contact-info');
    Cufon.replace('#contactinfo-send-form label');
   
   
})
