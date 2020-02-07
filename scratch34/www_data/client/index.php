<?php
$PAGE_TITLE = "Home"; // set page for use in title tag
require_once("utilCommon.php"); // init common PHP functions
// global variables - get from PHP
echo "<script>";
echo "var php_project_root = '" . PROJECT_ROOT . "';";
echo "var php_project_data = '" . PROJECT_DATA . "';";
echo "var gs_BaseURL = '" . "http://10.17.160.248:8012/geoserver" . "';";
echo "</script>";
require_once("views/header.php"); // include header
?>
<body class="bg-dark">
<?php require_once("views/nav.php"); ?>

<script>
    rsDivShown = false;
    prDivShown = false;

    // make the road surface image URLs global so the url can be updated without download the image.
    var intensityIMG = '';
    var depthIMG = '';
    var predIMG = '';

    var checkURL = function (thisURL) {
        return thisURL;
    };

    var updateIMG = function (intensityURL, depthURL) {
        iURL = checkURL(intensityURL);
        dURL = checkURL(depthURL);
        $('#pI').attr("src", iURL);
        $('#pD').attr("src", dURL);
    };

    var updatePredIMG = function (predURL) {
        pURL = checkURL(predURL);
        $('#prI').attr("src", pURL);
    };

    var togglePredBeside = function () {
        if (prDivShown === false) {
            // not shown, show it now.
            $("#prDiv").removeClass("d-none");
            // $("#data").removeClass("col-lg-3");
            // $("#data").addClass("col-lg-2");
            $("#togglePred").html("Hide Predictions");
            updatePredIMG(predIMG);
            // $("#tables").addClass("d-none");
            // $("#topform").addClass("d-none");
            prDivShown = true;
        } else {
            // shown, hide it now.
            $("#prDiv").addClass("d-none");
            // $("#data").removeClass("col-lg-3");
            // $("#data").addClass("col-lg-2");
            $("#togglePred").html("Show Predictions");
            // $("#tables").removeClass("d-none");
            // $("#topform").removeClass("d-none");
            prDivShown = false;
        }
    };

    var toggleRoadBeside = function () {
        if (rsDivShown === false) {
            $("#rsDiv").removeClass("d-none");
            // $("#data").removeClass("col-lg-3");
            // $("#data").addClass("col-lg-2");
            $("#toggleRB").html("Hide Road Images");
            updateIMG(intensityIMG, depthIMG);
            // $("#tables").addClass("d-none");
            // $("#topform").addClass("d-none");
            rsDivShown = true;
        } else {
            $("#rsDiv").addClass("d-none");
            // $("#data").removeClass("col-lg-3");
            // $("#data").addClass("col-lg-2");
            $("#toggleRB").html("Show Road Images");
            // $("#tables").removeClass("d-none");
            // $("#topform").removeClass("d-none");
            rsDivShown = false;
        }
    };
</script>
<!-- Begin page content -->
<main role="main" class="no-gutters p-0 m-0">
    <div class="row m-0" style="">
        <div id="data" class="col-xs-12 col-lg-3 p-0 bg-light border-right border-dark heightWindow" style="overflow-y: scroll;">
            <div id="layersidebar">
                <style>
                    #layers ul {
                        list-style-type: none;
                        font-weight: bold;
                    }

                    #layers ul li ul {
                        list-style-type: none;
                        font-weight: normal;
                    }
                </style>
                <div id="legend" class="row m-0 p-0 bg-light">
                    <h3 class="row m-0 pt-2 pb-1 pr-0 pl-4 bg-light border-top border-light">Legend</h3>
                    <div class="col-10 offset-1">
                        <img class="bg-white border m-0 p-1" src="<?php echo PROJECT_ROOT . "/images/legend-temporary.png"; ?>"
                             alt="Legend for Southern Roads" />
                    </div>
                </div>
                <h3 class="row m-0 pt-2 pb-1 pr-0 pl-4 bg-light border-top border-light">
                    Layers&nbsp;
                    <button id="layerspinner" class="btn  btn-outline-dark rounded-pill btn-sm" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </h3>
                <div id="layers" class="row m-0 p-0 bg-light"></div> <!-- filled by ol-layerswitcher -->
<!--                <div id="topform" class="row m-0 btn-group special px-1 py-0 bg-white pt-1" role="group" data-toggle="buttons">-->
<!--                    <input id="searchBar" type="text" class="col-8 form-control-plaintext border border-1 border-dark mb-2 pl-2"-->
<!--                           placeholder="query" disabled="disabled">-->
<!--                    <button type="submit" class="col btn text-success btn-outline-secondary mb-2 font-weight-normal border border-1 border-dark"-->
<!--                            disabled="disabled">Search-->
<!--                    </button>-->
<!--                    <button type="button" disabled="disabled" class="col btn text-info btn-outline-secondary-->
<!--                                mb-2 font-weight-normal border border-1 border-dark" data-toggle="modal" data-target="#queryModal">-->
<!--                        Advanced Search-->
<!--                    </button>-->
<!--                </div>-->
<!--                <div class="row btn-group special bg-white m-0 px-1 py-0 pb-2" role="group" data-toggle="buttons">-->
<!--                    <div class="w-100"></div>-->
<!--                    <button type="button" class="btn text-dark btn-outline-secondary font-weight-normal border border-1 border-dark"-->
<!--                            onclick='toggleRoadBeside();' id="toggleRB">-->
<!--                        Show Road Images-->
<!--                    </button>-->
<!--                    <button type="button" class="btn text-dark btn-outline-secondary font-weight-normal border border-1 border-dark"-->
<!--                            onclick='togglePredBeside();' id="togglePred">-->
<!--                        Show Predictions-->
<!--                    </button>-->
<!--                   button type="button" class="btn text-dark btn-outline-secondary font-weight-normal border border-1 border-dark"-->
<!--                    data-toggle="modal" data-target="#downloadModal">-->
<!--                   Future Button-->
<!--                   </button>-->
<!--                </div>-->

<!--                <div class="row p-0 m-0 bg-white">-->
<!--                    <div id="rsDiv" class="d-none">-->
<!--                        <div class="col-12">-->
<!--                            <span>Pavement Intensity (Visible)</span>-->
<!--                            <img id="pI" src="https://via.placeholder.com/900x1800/EEE/000?text=+" class="img-fluid border border-1 border-primary"/>-->
<!--                        </div>-->
<!--                        <div class="col-12">-->
<!--                            <br/>-->
<!--                            <span>Pavement Depth (Laser)</span>-->
<!--                            <img id="pD" src="https://via.placeholder.com/900x1800/EEE/000?text=+" class="img-fluid border border-1 border-primary"/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div id="prDiv" class="col-12 d-none">-->
<!--                        <span>Predicted Distress (Mask R-CNN)</span>-->
<!--                        <img id="prI" src="https://via.placeholder.com/900x1800/EEE/000?text=+" class="img-fluid border border-1 border-primary"/>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div id="tables" class="row m-0 p-0">
<!--                    <table class="table table-responsive-sm table-bordered table-sm col-12 mb-0">-->
<!--                        <thead class="">-->
<!--                        <tr>-->
<!--                            <th scope="col" class="table-active">Attribute</th>-->
<!--                            <th scope="col" class="table-active">Value</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <th scope="row">Section ID</th>-->
<!--                            <td id="pID"><span class="text-warning font-italic">Hover a road section</span></td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <th scope="row">Lat/Lon</th>-->
<!--                            <td id="pLatLon"></td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <th scope="row">Direction of Travel</th>-->
<!--                            <td id="pHeading"></td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <th scope="row">Vehicle Speed</th>-->
<!--                            <td id="pSpeed"></td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <th scope="row">Image DateTime</th>-->
<!--                            <td id="pTime"></td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                    --><?php
//                    //                $distressData = lookup_distress($pavementID);
//                    $distressData = array(
////                    "1" => 1,// Longitudinal => Low
////                    "2" => 2,// Transverse => Medium
////                    "3" => 3,// Alligator => High
////                    "4" => 999,// Patching => Not Rated
////                    "5" => 1,// Manhole => Low
////                    "6" => 3,// Marking => High
////                    "7" => 1// Other Objects => Low
//                        "1" => 999,
//                        "2" => 999,
//                        "3" => 999,
//                        "4" => 999,
//                    );
//                    pv_genTableForm($distressData);
//                    ?>
<!--                </div>-->
            </div>
        </div>

        <div id="map" class="col-xs-12 col-lg-9 p-0 bg-white heightWindow" style="width: 100%"></div>
        <!-- map before container to fill top portion of window with map -->
    </div>
    <div id="info"></div>
    <!-- Modal Pages, included by PHP -->
    <?php
    require_once('views/query.modal.inc.php');
    require_once('views/download.modal.inc.php');
    ?>
    <!-- Main JavaScript section -->
    <script type="text/javascript">
        var prevOut = false;

        // create tooltip holder
        var info = $('#info');
        info.tooltip({
            animation: false,
            'html': true,
            trigger: 'manual'
        });


        // ##################################################################################
        // ##################################################################################
        // ##################################################################################
        var gs_no_cache = new ol.layer.Tile({
            title: 'GS No Cache',
            visible: false,
            source: new ol.source.TileWMS({
                url: 'http://10.17.160.248:8012/geoserver/topaz/wms',
                params: {
                    'FORMAT': 'image/png',
                    'VERSION': '1.1.1',
                    tiled: true,
                    STYLES: '',
                    LAYERS: 'topaz:NC_Roads',
                    tilesOrigin: -84.32514400038389 + "," + 33.84384299955093
                }
            })
        });

        var projection = ol.proj.get('EPSG:4326');
        var projectionExtent = projection.getExtent();
        var mapExtent = [-105.70160457542876, 39.799058451017345, -104.99644707392322, 40.301219114868005];
        var matrixIds = new Array(22);

        for (var z = 0; z < 22; ++z) {
            matrixIds[z] = "EPSG:4326:" + z;
        }

        resolutions = [
            0.703125, 0.3515625, 0.17578125, 0.087890625,
            0.0439453125, 0.02197265625, 0.010986328125,
            0.0054931640625, 0.00274658203125, 0.001373291015625,
            6.866455078125E-4, 3.4332275390625E-4, 1.71661376953125E-4,
            8.58306884765625E-5, 4.291534423828125E-5, 2.1457672119140625E-5,
            1.0728836059570312E-5, 5.364418029785156E-6, 2.682209014892578E-6,
            1.341104507446289E-6, 6.705522537231445E-7, 3.3527612686157227E-7
        ];

        gs_gwc2_cache = new ol.layer.Tile({
            title: 'GS GWC 2 Cache',
            visible: false,
            source: new ol.source.WMTS({
                url: 'http://10.17.160.248:8012/geoserver/gwc/service/wmts',
                layer: 'topaz:NC_Roads',
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

        var gs_gwc_cache = new ol.layer.Tile({
            title: 'GS GWC Cache',
            visible: false,
            source: new ol.source.TileWMS({
                // https://gis.zslocum.dev:5443/geoserver/gwc/service/wmts
                // ?layer=utility%3ANC_Roads&style=&tilematrixset=EPSG%3A4326
                // &Service=WMTS&Request=GetTile&Version=1.0.0&Format=image%2Fpng
                // &TileMatrix=EPSG%3A4326%3A7&TileCol=73&TileRow=38
                url: 'http://10.17.160.248:8012/geoserver/gwc/service/wmts',
                params: {
                    'FORMAT': 'image/png',
                    'layer': 'topaz:NC_Roads',
                    'style': '',
                    'tilematrixset': 'EPSG:4326',
                    'Service': 'WMTS',
                    'Request': 'GetTile',
                    'Version': '1.0.0',
                    'Format': 'image/png',
                    'TileMatrix': 'EPSG:4326:7',

                    // tiled: true,
                    // style: '',
                    // LAYERS: 'utility:NC_Roads',
                    // tilesOrigin: -84.32514400038389 + "," + 33.84384299955093
                }
            })
        });

        // var eleclines = createGeoserverVectorLayer('Transmission Lines', 'utility:Electric_Power_Transmission_Lines', ElecTransLineStyle, false, 1250);


        var gsman_LandCover2016_TilePNG_WMS = new ol.layer.Tile({
            title: 'Manager: Land Cover 2016 TilePNG WMS',
            visible: false,
            opacity: 0.7,
            source: new ol.source.TileWMS({
                url: 'http://10.17.160.248:8010/geoserver/topaz/wms',
                params: {
                    'FORMAT': 'image/png',
                    'VERSION': '1.1.1',
                    tiled: true,
                    STYLES: 'topaz:LandCoverSimple',
                    LAYERS: 'topaz:reproject2016',
                    tilesOrigin: -84.32514400038389 + "," + 33.84384299955093
                }
            })
        });

        var gsman_LandCover2016_TilePNG_GWC = new ol.layer.Tile({
            title: 'Manager: Land Cover 2016 TilePNG GWC',
            visible: false,
            opacity: 0.7,
            source: new ol.source.WMTS({
                url: 'http://10.17.160.248:8010/geoserver/gwc/service/wmts',
                layer: 'topaz:reproject2016',
                matrixSet: 'EPSG:4326',
                format: 'image/png',
                style: 'topaz:LandCover',
                projection: projection,
                tileGrid: new ol.tilegrid.WMTS({
                    origin: ol.extent.getTopLeft(projectionExtent),
                    resolutions: resolutions,
                    matrixIds: matrixIds
                })
            })
        });


    </script>
    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/js/ol_roads.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/js/ol_basemaps.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/js/ol_legendstyles.js'; ?>"></script>
    <script type="text/javascript">
        // ##################################################################################
        // create view for map object
        var myView = new ol.View({
            // this variable tells OpenLayers where to focus the map on load.
            // center: ol.proj.fromLonLat([-80.731686, 35.3260]),
            center: ol.proj.fromLonLat([-80.730030, 35.306888]),
            // center: ol.proj.fromLonLat([-76.9430000,35.9955000]),
            zoom: 15,
            minZoom: 5,
            maxZoom: 19
        });

        var map = new ol.Map({
            moveTolerance: 4,
            view: myView,
            target: 'map',
            layers: [ // layers and layer groups are added to sidebar in reverse order, basemaps at the bottom.
                basemapGroup,

                // new ol.layer.Group({
                //     title: 'Land Cover 2016',
                //     layers: [
                //         gsman_LandCover2016_TilePNG_WMS,
                //         gsman_LandCover2016_TilePNG_GWC,
                //     ]
                // }),

                // new ol.layer.Group({
                //     title: 'Southern US Roads',
                //     layers: [
                //         gswork_SouthRoads_WMS,
                //         gsman_SouthRoads_WMS,
                //
                //         gswork_SouthRoads_GWC,
                //         gsman_SouthRoads_GWC,
                //     ]
                // }),

                new ol.layer.Group({
                    title: 'Southern US Roads',
                    layers: [
                        new ol.layer.Group({
                            title: 'Web Map Tile Service',
                            layers: [
                                gswork_SouthRoads_WMS,
                                gsman_SouthRoads_WMS,
                            ]
                        }),
                        new ol.layer.Group({
                            title: 'GeoWebCache',
                            layers: [
                                gswork_SouthRoads_GWC,
                                gsman_SouthRoads_GWC,
                            ]
                        }),
                    ]
                }),



                // new ol.layer.Group({
                //     title: 'NC Pavement',
                //     layers: [
                //         pvmt_points_wfs,
                //         pvmt_points_detail,
                //         pvmt_points_overview
                //     ]
                // }),

            ],
        });


        // add layer switcher to sidebar by id
        var toc = document.getElementById("layers");
        ol.control.LayerSwitcher.renderPanel(map, toc);

        // Create the graticule component
        var graticule = new ol.Graticule({
            // the style to use for the lines, optional.
            strokeStyle: new ol.style.Stroke({
                color: 'rgba(255,120,0,0.9)',
                width: 1.5,
                lineDash: [1, 18]
            }),
            showLabels: true, // show lat/lon values on edge of map window
            map: map, // add to map object
        });

        // Create the dynamic scale line component
        var scaleLineControl = new ol.control.ScaleLine({
            units: "us"
        });
        map.addControl(scaleLineControl);


        $("#layerspinner").show();

        // hide after render has been completed
        map.on("rendercomplete", function () {
            // console.log("SPINNER: rendercomplete");
            $("#layerspinner").hide();
            $("#layerspinner").fadeOut(900);
            loadStylesToLegend();
        });

        // show again on map change
        map.on("postcompose", function () {
            // console.log("SPINNER: postcompose");
            $("#layerspinner").show();
            $("#layerspinner").stop(true);
            // $("#layerspinner").fadeIn(30);
        });

        // show again on map change
        map.on("precompose", function () {
            // console.log("SPINNER: precompose");
            $("#layerspinner").show();
            $("#layerspinner").stop(true);
            // $("#layerspinner").fadeIn(30);

        });

    </script>

    <script>
        var mylegend = "<div style='textalign: center;'>"
            + "<img src='/client/images/legend-temporary.png'/>"
            + "</div>";
        // findElementByText("Southern US Roads").html("<strong style=''>"+"Southern US Roads"+"</strong>" + mylegend);
    </script>

    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/js/ol_geocoder.js'; ?>"></script>
</main>

<?php require_once("views/cite.php"); ?>
