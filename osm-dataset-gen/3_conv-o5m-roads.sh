#!/bin/bash

for thisFile in *.o5m
do
	echo "=== Processing $thisFile... ==="
	echo "  Motorway..."
	osmfilter $thisFile --keep="highway=motorway*" --drop-author --drop-version -o=$thisFile-motorway.osm
	echo "  Trunk..."
	osmfilter $thisFile --keep="highway=trunk*" --drop-author --drop-version -o=$thisFile-trunk.osm
	echo "  Primary..."
	osmfilter $thisFile --keep="highway=primary*" --drop-author --drop-version -o=$thisFile-primary.osm
	echo "  Secondary..."
	osmfilter $thisFile --keep="highway=secondary*" --drop-author --drop-version -o=$thisFile-secondary.osm
	echo "  Tertiary..."
	osmfilter $thisFile --keep="highway=tertiary*" --drop-author --drop-version -o=$thisFile-tertiary.osm
	echo "  Unclassified..."
	osmfilter $thisFile --keep="highway=unclassified*" --drop-author --drop-version -o=$thisFile-unclassified.osm
	echo "  Residential..."
	osmfilter $thisFile --keep="highway=residential*" --drop-author --drop-version -o=$thisFile-residential.osm
	echo "  Others..."
	osmfilter $thisFile --keep="highway=living_street =service =pedestrian =track =bus_guideway =escape =raceway =road =construction" --drop-author --drop-version -o=$thisFile-others.osm
	echo "=== Done. Moving to next file. ==="
done

