var geocoder = new google.maps.Geocoder();
$(document).ready(function(){

    var locationElements =  $('a.location-link');
    
    Array.from(locationElements).forEach( function(element){
        var city = element.getAttribute('data-city');
        var country =element.getAttribute('data-country');
        setLonLat(city+'-'+country, element)
    });

})


function setLonLat(region , element){
    geocoder.geocode({ 'address': region }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            element.setAttribute('href','https://www.google.com/maps?q='+ latitude+','+longitude)
        }
    });
}