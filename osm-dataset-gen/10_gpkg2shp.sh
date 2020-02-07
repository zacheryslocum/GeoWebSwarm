#!/bin/bash

for file2 in *.gpkg
do
	noExt=${file2/.gpkg}
	echo "Working on $file2"
	ogrmerge.py -f "ESRI Shapefile" -o shapes/$noExt.shp $file2 -src_geom_type LINESTRING -progress -single
done
