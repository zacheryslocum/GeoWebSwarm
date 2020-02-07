#!/bin/bash

osmconvert us-midwest-latest.osm.pbf -o=midwest.o5m
osmconvert us-northeast-latest.osm.pbf -o=northeast.o5m
osmconvert us-pacific-latest.osm.pbf -o=pacific.o5m
osmconvert us-south-latest.osm.pbf -o=south.o5m
osmconvert us-west-latest.osm.pbf -o=west.o5m

