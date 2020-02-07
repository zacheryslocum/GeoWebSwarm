#!/bin/bash

# Create directories for GeoSwarm on NFS share

cd $1

mkdir geo_datasets
mkdir gs_data
mkdir gs_gwc
mkdir log_data
mkdir www_data

# Configure logging in Geoserver
echo "<logging>
  <level>DEFAULT_LOGGING.properties</level>
  <stdOutLogging>false</stdOutLogging>
</logging>" >> gs_data/logging.xml

# Configure GeoWebCache in Geoserver
echo "<?xml version="1.0" encoding="utf-8"?>
<gwcConfiguration xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://geowebcache.org/schema/1.15.0 http://geowebcache.org/schema/1.15.0/geowebcache.xsd" xmlns="http://geowebcache.org/schema/1.15.0">
  <version>1.15.0</version>
  <backendTimeout>120</backendTimeout>
  <blobStores>
    <FileBlobStore default="true">
      <id>blob1</id>
      <enabled>true</enabled>
      <baseDirectory>/opt/geoserver/data_dir/gwc</baseDirectory>
      <fileSystemBlockSize>4096</fileSystemBlockSize>
    </FileBlobStore>
  </blobStores>
  <gridSets/>
  <layers/>
</gwcConfiguration>" >> gs_data/gwc/geowebcache.xml


chmod 777 -R *


echo "== Done! =="
echo "== Please configure the current directory as an NFS share. =="
