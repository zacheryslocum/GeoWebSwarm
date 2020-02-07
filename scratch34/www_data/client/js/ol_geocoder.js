// ol-geocoder to allow searching map.
var geocoder = new Geocoder('nominatim', {
    provider: 'osm',
    key: '',
    lang: 'en-US', //en-US, fr-FR
    countrycodes: 'us',
    placeholder: 'Search for ...',
    targetType: 'text-input',
    autocomplete: false,
    limit: 5,
    keepOpen: true
});
map.addControl(geocoder);
geocoder.on('addresschosen', function (evt) {
    var feature = evt.feature,
        coord = evt.coordinate,
        address = evt.address;
    // some popup solution
    content.innerHTML = '<p>' + address.formatted + '</p>';
    overlay.setPosition(coord);
    map.getLayers().forEach(function (layer) {
        //If this is actually a group, we need to create an inner loop to go through its individual layers
        if (layer instanceof ol.layer.Group) {
            layer.getLayers().forEach(function (groupLayer) {
                groupLayer.getSource().refresh(); // re-draw the map tiles after movement
            });
        } else if (layer instanceof ol.layer.Vector)
            layer.getSource().refresh(); // re-draw the map tiles after movement
    });

});