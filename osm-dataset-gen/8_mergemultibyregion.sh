#!/bin/bash

ogrmerge.py -f GPKG -o shapes/midwest.gpkg midwest*.gpkg -src_geom_type LINESTRING -progress -single -nln midwest

ogrmerge.py -f GPKG -o shapes/west.gpkg west*.gpkg -src_geom_type LINESTRING -progress -single -nln west

ogrmerge.py -f GPKG -o shapes/south.gpkg south*.gpkg -src_geom_type LINESTRING -progress -single -nln south

ogrmerge.py -f GPKG -o shapes/pacific.gpkg pacific*.gpkg -src_geom_type LINESTRING -progress -single -nln pacific

ogrmerge.py -f GPKG -o shapes/northeast.gpkg northeast*.gpkg -src_geom_type LINESTRING -progress -single -nln northeast

