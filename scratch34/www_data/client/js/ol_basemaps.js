var ArcGISlightgrey = new ol.layer.Tile({
    title: 'ArcGIS Online Light Gray',
    visible: false,
    type: 'base',
    preload: Infinity,
    source: new ol.source.TileArcGISRest({
        url: 'https://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer'
    })
});

var tonerlite = new ol.layer.Tile({
    title: "Stamen Toner Lite",
    visible: false,
    type: 'base',
    preload: Infinity,
    source: new ol.source.Stamen({
        layer: 'toner-lite',
    }),
});

var stockOSM = new ol.layer.Tile({
    // use OpenStreetMap basemap',
    title: 'OpenStreetMap',
    visible: false,
    type: 'base',
    preload: Infinity,
    source: new ol.source.OSM({
        cacheSize: 3072,
        wrapX: false,
    })
});

var trOSM = new ol.layer.Tile({
    // use OpenStreetMap basemap
    title: 'OpenStreetMap Overlay',
    opacity: 0.75,
    visible: false,
    preload: Infinity,
    source: new ol.source.OSM()
});

// Bing Maps imagerySet options:
// - Aerial: Aerial imagery.
// - AerialWithLabels: Aerial imagery with a road overlay.
// - AerialWithLabelsOnDemand: Aerial imagery with on-demand road overlay.
// - CanvasDark: A dark version of the road maps.
// - CanvasLight: A lighter version of the road maps which also has some of the details such as hill shading disabled.
// - CanvasGray: A grayscale version of the road maps.
// - Road: Roads without additional imagery.
// - Streetside: Street-level Imagery.
var bingAerial = new ol.layer.Tile({
    title: 'Bing Aerial',
    type: 'base',
    visible: true,
    preload: Infinity,
    source: new ol.source.BingMaps({
        key: 'Apr5UKgqbNz6MXyIBzmWJYyDXhQpSTlYoRbzpCQVUPdaqngpSgNNKg1l6gt1wEiU',
        imagerySet: 'Aerial',
        maxZoom: 19
    })
});


var bingAerialLabels = new ol.layer.Tile({
    title: 'Bing Aerial + Labels',
    type: 'base',
    visible: false,
    preload: Infinity,
    source: new ol.source.BingMaps({
        key: 'Apr5UKgqbNz6MXyIBzmWJYyDXhQpSTlYoRbzpCQVUPdaqngpSgNNKg1l6gt1wEiU',
        imagerySet: 'AerialWithLabels',
        maxZoom: 19
    })
});

var blankbase = new ol.layer.Vector({
    title: 'Blank',
    type: 'base',
    visible: false,
    source: new ol.source.Vector({})
});

blankbase.setSource(null);


var basemapGroup = new ol.layer.Group({
    title: 'Base Maps',
    layers: [
        stockOSM,
        bingAerial,
        bingAerialLabels,
        tonerlite,
        new ol.layer.Tile({
            title: 'Stamen Terrain',
            type: 'base',
            preload: Infinity,
            visible: false,
            source: new ol.source.Stamen({layer: 'terrain-background',})
        }),
        ArcGISlightgrey,
        blankbase,
        trOSM,
    ]
});