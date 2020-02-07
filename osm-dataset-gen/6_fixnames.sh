#!/bin/bash

for file2 in *.gpkg
do
	echo "Renaming $file2"
        mv "${file2}" "${file2/-/}"
done

echo "=== Merging all files' LINESTRING layers... ==="
ogrmerge.py -f GPKG -o merged.gpkg *.gpkg -src_geom_type LINESTRING -progress
