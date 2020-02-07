#!/bin/bash

# ogr2ogr -f GPKG output.gpkg pacific-motorway.osm --config OSM_CONFIG_FILE customOSMconfig.ini

for thisFile in *.osm
do
        echo "=== Processing $thisFile... ==="
	noExt=${thisFile/.osm}
	echo " - $noExt"
	        ogr2ogr -f GPKG $noExt.gpkg $thisFile --config OSM_CONFIG_FILE customOSMconfig.ini -progress
        echo "=== Done. Proceeding to next file... ==="
done

echo "=== ==="
echo "=== Merging all files' LINESTRING layers... ==="
ogrmerge.py -f GPKG -o merged.gpkg *.gpkg -src_geom_type LINESTRING -progress
