var loadStylesToLegend = function () {
    // document is loaded and DOM is ready
    // alert("document is ready");
    map.getLayers().forEach(function (layer) {
        //If this is actually a group, we need to create an inner loop to go through its individual layers
        if (layer instanceof ol.layer.Group) {
            layer.getLayers().forEach(function (groupLayer) {
                //If this is a vector layer, add it to our extent
                thisLayerTitle = groupLayer.get('title');
                thisLayerVisible = groupLayer.getVisible();
                // console.log(thisLayerTitle);
                if (groupLayer instanceof ol.layer.Vector) {
                    // console.log(thisLayerTitle + " VECTOR");
                    // console.log(groupLayer.getStyle());
                    try {
                        thisLayerStyle = lookupStyle(groupLayer.getSource().getFeatures()[0], overpassStyles);
                    } catch (err) {
                        // console.log('STYLE MISSING: ' + thisLayerTitle);
                        return;
                    }

                    // console.log(thisLayerStyle);
                    console.log(groupLayer.getSource().getFeatures()[0]);

                    thisLayerWidth = thisLayerStyle.getStroke().getWidth() * 1.5;

                    thisLayerColor = thisLayerStyle.getStroke().getColor();

                    var builtStyleDiv = "<div style='"
                        + "height:" + thisLayerWidth + ";"
                        + "background-color:" + thisLayerColor + ";"
                        + "margin-left: 1em; margin-bottom: 0.5em;width:2em;"
                        + "'>&nbsp;</div>";

                    findElementByText(thisLayerTitle).html(thisLayerTitle + builtStyleDiv);
                } else if (groupLayer instanceof ol.layer.Tile && thisLayerTitle.includes('GS M') && thisLayerVisible) {
                    // http://gsman:8054/geoserver/topaz/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=topaz:reproject2016&STYLE=LandCoverSimple
                    var thisLayerURL = groupLayer.getSource().getUrls();
                    if(thisLayerURL.toString().includes('wmts')) {
                        thisLayerURL = thisLayerURL.toString().replace(/wmts/g, 'wms');
                        var thisLayerLayer = groupLayer.getSource().layer_;
                        var thisLayerStyle = groupLayer.getSource().style_;
                    } else if (thisLayerURL.toString().includes('wms')) {
                        var thisLayerLayer = groupLayer.getSource().params_.LAYERS;
                        var thisLayerStyle = groupLayer.getSource().params_.STYLES;
                    }
                    var builtStyleDiv = "<div>"
                        + "<img src='"+thisLayerURL+"?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER="+thisLayerLayer+"&STYLE="+thisLayerStyle+"'/>"
                        + "</div>";
                    findElementByText(thisLayerTitle).html("<strong>"+thisLayerTitle+"</strong>" + builtStyleDiv);
                }
            });
        } else if (layer instanceof ol.layer.Vector) {
            //layer.getSource()
        }
    });
};