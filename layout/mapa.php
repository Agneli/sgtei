<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" >

    // Chamando a função initialize() quando o documento estiver pronto
    $(document).ready(function() {
        initialize();
    });

    var map, geocoder;
    var mapDisplay, directionsService;

    function initialize() {
        var myOptions = {zoom: 15, mapTypeId: google.maps.MapTypeId.ROADMAP};
        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
        geocoder = new google.maps.Geocoder();

        var enderDe = '<?php echo $route->getOri() ?>';
        var enderAte = '<?php echo $route->getDest() ?>';

        geocoder.geocode({'address': enderAte, 'region': 'BR'}, trataLocs);

        initializeDirections();

        calcRota(enderDe, enderAte);
    }

    function initializeDirections() {
        directionsService = new google.maps.DirectionsService();
        mapDisplay = new google.maps.DirectionsRenderer();
        mapDisplay.setMap(map);
    }

    function calcRota(endDe, endPara) {
        var request = {
            origin: endDe,
            destination: endPara,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                mapDisplay.setDirections(response);
            }
        });
    }

    function trataLocs(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location});
        } else
            elem.innerHTML = 'Erro no tratamento do endereço :<br /><b>' + status + '</b>';
    }

</script>
<div id="map_canvas"></div>