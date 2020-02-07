#!/bin/bash

for thisFile in *.gpkg
do
        echo "=== Processing $thisFile... ==="
        noExt=${thisFile/.osm}
        echo " - $noExt"
                ogr2ogr -f "ESRI Shapefile" shapes/$noExt.shp $thisFile --config OSM_CONFIG_FILE customOSMconfig.ini -progress
        echo "=== Done. Proceeding to next file... ==="
done
