#!/bin/bash

for file in *.o5m-*.osm
do 
	mv "${file}" "${file/.o5m/}"
done
