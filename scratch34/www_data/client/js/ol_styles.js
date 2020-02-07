var lookupStyle = function (feature, styleSet) {
    for (var key in styleSet) {
        var value = feature.get(key);
        if (value !== undefined) {
            for (var regexp in styleSet[key]) {
                if (new RegExp(regexp).test(value)) {
                    return styleSet[key][regexp];
                }
            }
        }
    }
};

// ///////////////////////////////////////////////////////////////////////////////////////
// create array to store styles
var styleCache = {};
// generate point styles
var styleFunction = function (feature) {
    // set a default radius. Change this to modify the 'show' option's points.
    var radius = 10;
    var style = styleCache[radius];
    if (!style) { // if style not yet cached, generate
        style = new ol.style.Style({
            image: new ol.style.Icon(({
                anchor: [0.5, 0.96],
                crossOrigin: 'anonymous',
                src: php_project_root + '/images/ol-marker-blue.png',
            }))
        }); // end new image style
        // cache the style data to array
        styleCache[radius] = style;
    } // end if no style
    return style;
};

// #####################################################################################

var rpStyle = new ol.style.Style({
    image: new ol.style.Icon(({
        anchor: [0.5, 0.96],
        crossOrigin: 'anonymous',
        src: php_project_root + '/images/ol-marker-gold.png',
    }))
}); // end new image style

var hlstyle = new ol.style.Style({
    image: new ol.style.Icon(({
        anchor: [0.5, 0.96],
        crossOrigin: 'anonymous',
        src: php_project_root + '/images/ol-marker-gold.png',
    }))
}); // end new image style

var nmstyle = new ol.style.Style({
    image: new ol.style.Icon(({
        anchor: [0.5, 0.96],
        crossOrigin: 'anonymous',
        src: php_project_root + '/images/ol-marker-red.png',
    }))
}); // end new image style

var highlightOverlayStyle = new ol.style.Style({
    image: new ol.style.Icon(({
        anchor: [0.5, 0.96],
        crossOrigin: 'anonymous',
        // src: php_project_root + '/images/ol-marker-gold.png',
        src: 'https://gis.zslocum.dev:5443/utility/images/ol-marker-gold.png',
    }))
});

var greyOutlinePolygon = new ol.style.Style({
    stroke: new ol.style.Stroke({
        color: 'rgba(128, 160, 128, 0.7)',
        width: 5
    }),
    fill: new ol.style.Fill({
        color: 'rgba(255, 255, 255, 0.0)'
    })
});

var yellowStroke = new ol.style.Style({
    stroke: new ol.style.Stroke({
        color: 'rgba(204, 204, 0, 0.8)',
        width: 4
    }),
    fill: new ol.style.Fill({
        color: 'rgba(255, 255, 255, 0.0)'
    })
});

var overpassStyles = {
    'railway': {
        '.*': new ol.style.Style({
            stroke: new ol.style.Stroke({
                // color: 'rgb(42,200,149)',
                color: 'rgb(46,145,217)',
                width: 3
            })
        })
    },
    'highway': {
        'motorway.*': new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'rgb(255, 0, 0)',
                width: 4
            })
        }),
        'trunk': new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'rgb(255,157,121)',
                width: 3
            })
        }),
        'primary': new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'rgb(255,184,95)',
                width: 3
            })
        }),
        '.*': new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'rgb(200, 200, 200)',
                width: 1
            })
        })
    },
};



var defaultGeoserverStyle = new ol.style.Style({
    stroke: new ol.style.Stroke({
        color: 'rgb(255,255,0)',
        width: 1
    })
});

var CrudeOilStyle = new ol.style.Style({
    stroke: new ol.style.Stroke({
        color: 'rgb(153, 102, 0)',
        width: 2
    })
});

var HGLStyle = new ol.style.Style({
    stroke: new ol.style.Stroke({
        color: 'rgb(128, 0, 0)',
        width: 2
    })
});

var ElecTransLineStyle = new ol.style.Style({
    stroke: new ol.style.Stroke({
        color: 'rgb(255,255,0)',
        width: 2
    })
});





