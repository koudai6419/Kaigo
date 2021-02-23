// onload処理
google.maps.event.addDomListener(window, 'load', function() {
    // Map設定
    var map = document.getElementById("map");
    var centerPosition = new google.maps.LatLng(40.822331, 140.747438);
    var options = {
        zoom: 16,
        center: centerPosition,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // Mapの出力
    new google.maps.Map(map, options);
});
