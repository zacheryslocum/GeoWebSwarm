//      ________  ___   ______________________  _   _______
//     / ____/ / / / | / / ____/_  __/  _/ __ \/ | / / ___/
//    / /_  / / / /  |/ / /     / /  / // / / /  |/ /\__ \
//   / __/ / /_/ / /|  / /___  / / _/ // /_/ / /|  /___/ /
//  /_/    \____/_/ |_/\____/ /_/ /___/\____/_/ |_//____/
//

function findElementByText(text) {
    var jSpot = $("label:contains(" + text + ")")
            .filter(function () {
                return $(this).children().length === 0;
            })
        // .parent();  // because you asked the parent of that element
    ;

    return jSpot;
}

// correctly format numbers. greatly improves readability.
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

var gMapsLink = function (inLat, inLon, inZoom = 16) {
    console.log("Res: " + map.getView().getResolution());
    console.log("Zoom: " + map.getView().getZoom());
    // console.log(parseInt(map.getView().getResolutionForZoom(map.getView().getZoom())));
    return '<a target="_blank" href="https://www.google.com/maps/@?api=1&map_action=map&center='
        + inLat.toString()
        + ','
        + inLon.toString()
        + '&zoom=' + inZoom
        + '&basemap=satellite&layer=transit">'
        + inLat.toString()
        + ','
        + inLon.toString()
        + '</a>'
};

var getCurrentViewExtent = function(reverse=false) {
    var viewExtent = map.getView().calculateExtent();
    var epsg4326Extent = ol.proj.transformExtent(viewExtent, map.getView().getProjection(), 'EPSG:4326');
    var stringExtent = '';
    if(reverse) {
        stringExtent = epsg4326Extent[0] + ',' + epsg4326Extent[1] + ',' +
            epsg4326Extent[2] + ',' + epsg4326Extent[3];
    } else {
        stringExtent = epsg4326Extent[1] + ',' + epsg4326Extent[0] + ',' +
            epsg4326Extent[3] + ',' + epsg4326Extent[2];
    }
    return stringExtent;
};

function getBBOXcenter(inBBOX) {
    // https://gis.stackexchange.com/questions/8650/measuring-accuracy-of-latitude-and-longitude
    var X = inBBOX[0] + (inBBOX[2] - inBBOX[0]) / 2;
    var Y = inBBOX[1] + (inBBOX[3] - inBBOX[1]) / 2;
    return [X.toFixed(6), Y.toFixed(6)];
}
// var centroid = getBBOXcenter(feature.get('bbox'));
// console.log(centroid);


//      __    _____  ____________     _____________   __
//     / /   /   \ \/ / ____/ __ \   / ____/ ____/ | / /
//    / /   / /| |\  / __/ / /_/ /  / / __/ __/ /  |/ /
//   / /___/ ___ |/ / /___/ _, _/  / /_/ / /___/ /|  /
//  /_____/_/  |_/_/_____/_/ |_|   \____/_____/_/ |_/
//
var createOverpassSource = function (thisSearch = 'way["highway"~"motorway"]') {
    return new ol.source.Vector({
        format: new ol.format.GeoJSON(),
        loader: function (extent, resolution, projection) {
            var currentViewExtent = getCurrentViewExtent();
            var query = '[out:json][timeout:300][maxsize:2147483648];' + '(' +
                // The next line asks for specific attributes from the OSM data
                thisSearch +
                '(' + currentViewExtent + ');' +
                ');' + 'out body;' + '>;' + 'out skel qt;';
            // fetch('https://overpass-api.de/api/interpreter', {
            fetch('https://gis.zslocum.dev:6643/api/interpreter',
                {method: "POST", body: query})
                .then(response => response.json()).then(json => {
                const geojson = osmtogeojson(json, {flatProperties: true});
                var features = new ol.format.GeoJSON().readFeatures(geojson, {
                    featureProjection: map.getView().getProjection()
                });
                this.addFeatures(features); // add downloaded features to the current layer
            });
        },
        strategy: ol.loadingstrategy.bbox // re-run the loader function for each change to the view
    });
};

var createOverpassLayer = function (thisTitle = 'OSM Interstates',
                                    thisSearch = 'way["highway"~"motorway"]',
                                    thisVisible = true, thisMaxRes = 1250) {
    return new ol.layer.Vector({
        title: thisTitle,
        visible: thisVisible,
        renderMode: 'vector',
        preload: Infinity,
        style: function (feature) {
            return lookupStyle(feature, overpassStyles) || null;
        },
        maxResolution: thisMaxRes,
        source: createOverpassSource(thisSearch),
    });
};

var getMaxResAtZoom = function(inZoom = 10) {
    return parseInt(map.getView().getResolutionForZoom(inZoom));
};

var createGeoserverVectorLayer = function (thisTitle = 'Geoserver',
                                           thisSearch = 'utility:Electric_Power_Transmission_Lines',
                                           thisStyle = defaultGeoserverStyle,
                                           thisVisible = true, thisMaxRes = 1250,
                                           thisWorkspace = 'topaz',
                                           thisGSURL = gs_BaseURL) {
    return new ol.layer.Vector({
        title: thisTitle,
        visible: thisVisible,
        renderMode: 'vector',
        // preload: Infinity,
        style: thisStyle,
        maxResolution: thisMaxRes,
        source: new ol.source.Vector({
            format: new ol.format.GeoJSON(),
            url: function (extent) {
                return thisGSURL + '/' + thisWorkspace + '/ows?service=WFS&version=1.0.0' +
                    '&request=GetFeature' +
                    '&typeName=' + thisSearch +
                    '&maxFeatures=10000&outputFormat=application%2Fjson'
                    + '&bbox=' + getCurrentViewExtent(true);
            },
            strategy: ol.loadingstrategy.bbox,
        }),
    })
};