#!/bin/bash

ogrmerge.py -f "ESRI Shapefile" -o shapes/midwest.shp midwest*.gpkg -src_geom_type LINESTRING -progress -single

ogrmerge.py -f "ESRI Shapefile" -o shapes/west.shp west*.gpkg -src_geom_type LINESTRING -progress -single

ogrmerge.py -f "ESRI Shapefile" -o shapes/south.shp south*.gpkg -src_geom_type LINESTRING -progress -single

ogrmerge.py -f "ESRI Shapefile" -o shapes/pacific.shp pacific*.gpkg -src_geom_type LINESTRING -progress -single

ogrmerge.py -f "ESRI Shapefile" -o shapes/northeast.shp northeast*.gpkg -src_geom_type LINESTRING -progress -single

