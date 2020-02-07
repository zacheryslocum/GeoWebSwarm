// generate point layer from geoserver
var pvmt_points_wfs = new ol.layer.Vector({
    visible: false,
    title: 'Pavement Images WFS',
    preload: 24,
    declutter: true,
    source: new ol.source.Vector({
        format: new ol.format.GeoJSON(),
        url: function(extent) {
            return 'http://10.17.160.248:8010/geoserver/topaz/ows?service=' +
                'WFS&version=1.0.0&request=GetFeature&typeName=topaz:pvmt_pred' +
                '&outputFormat=application/json&srsname=EPSG:3857' +
                '&bbox=' + extent.join(',') + ',EPSG:3857';
        },
        // strategy: ol.loadingstrategy.bbox()
    }),
    style: styleFunction(),
});


var pvmt_points_detail = new ol.layer.Vector({
    visible: false,
    title: 'Pavement Images KML',
    preload: 24,
    declutter: true,
    source: new ol.source.Vector({
        url: 'http://10.17.160.248:8010/geoserver/topaz/ows?service='
            + 'WFS&version=1.0.0&request=GetFeature&typeName=topaz:pvmt_pred'
            + '&outputFormat=application%2Fvnd.google-earth.kml%2Bxml',
        format: new ol.format.KML({
            extractStyles: false
        })
    }),
    style: styleFunction(),
});

var pvmt_points_overview = new ol.layer.Tile({
    title: 'Pavement Images Overview',
        visible: false,
        source: new ol.source.TileWMS({
            url: 'http://10.17.160.248:8010/geoserver/topaz/wms',
            params: {
                'FORMAT': 'image/png',
                'VERSION': '1.1.1',
                tiled: true,
                STYLES: '',
                LAYERS: 'topaz:pvmt_pred',
                tilesOrigin: -84.32514400038389 + "," + 33.84384299955093
            }
        })
    });





var gsman_SouthRoads_WMS = new ol.layer.Tile({
    title: 'Single: South Roads WMS',
    visible: false,
    source: new ol.source.TileWMS({
        url: 'http://10.17.160.248:8010/geoserver/topaz/wms',
        params: {
            'FORMAT': 'image/png',
            'VERSION': '1.1.1',
            tiled: true,
            STYLES: '',
            LAYERS: 'topaz:South Roads',
            tilesOrigin: -84.32514400038389 + "," + 33.84384299955093
        }
    })
});



var gswork_SouthRoads_WMS = new ol.layer.Tile({
    title: 'Multiple: South Roads WMS',
    visible: false,
    source: new ol.source.TileWMS({
        // url: 'http://10.17.160.248:8014/geoserver/topaz/wms',
        urls: [
            'http://10.17.160.248:8012/geoserver/topaz/wms',
            'http://10.17.160.248:8014/geoserver/topaz/wms'
            ],
        params: {
            'FORMAT': 'image/png',
            'VERSION': '1.1.1',
            tiled: true,
            STYLES: '',
            LAYERS: 'topaz:South Roads',
            tilesOrigin: -84.32514400038389 + "," + 33.84384299955093
        }
    })
});










var gswork_SouthRoads_GWC = new ol.layer.Tile({
    title: 'Multiple: South Roads GWC',
    visible: false,
    source: new ol.source.WMTS({
        // url: 'http://10.17.160.248:8012/geoserver/gwc/service/wmts',
        urls: [
            'http://10.17.160.248:8012/geoserver/gwc/service/wmts',
            'http://10.17.160.248:8014/geoserver/gwc/service/wmts'
            ],
        layer: 'topaz:South Roads',
        matrixSet: 'EPSG:4326',
        format: 'image/png',
        projection: projection,
        tileGrid: new ol.tilegrid.WMTS({
            origin: ol.extent.getTopLeft(projectionExtent),
            resolutions: resolutions,
            matrixIds: matrixIds
        })
    })
});


var gsman_SouthRoads_GWC = new ol.layer.Tile({
    title: 'Single: South Roads GWC',
    visible: true,
    source: new ol.source.WMTS({
        url: 'http://10.17.160.248:8010/geoserver/gwc/service/wmts',
        layer: 'topaz:South Roads',
        matrixSet: 'EPSG:4326',
        format: 'image/png',
        projection: projection,
        tileGrid: new ol.tilegrid.WMTS({
            origin: ol.extent.getTopLeft(projectionExtent),
            resolutions: resolutions,
            matrixIds: matrixIds
        })
    })
});