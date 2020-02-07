#!/bin/bash
set -e

source /root/.bashrc

GEOSERVER_OPTS=$(echo $GEOSERVER_OPTS | sed "s|-Xms[a-zA-Z0-9]*|-Xms6G |g")
GEOSERVER_OPTS=$(echo $GEOSERVER_OPTS | sed "s|-Xmx[a-zA-Z0-9]*|-Xmx12G |g")

echo \n$GEOSERVER_OPTS >> /root/.bashrc

GEOSERVER_OPTS="-Djava.awt.headless=true -server -Xms6G -Xmx12G -Xrs -XX:PerfDataSamplingInterval=500 \
       -Dorg.geotools.referencing.forceXY=true -XX:SoftRefLRUPolicyMSPerMB=36000 -XX:+UseParallelGC -XX:NewRatio=2 \
       -XX:+CMSClassUnloadingEnabled -Dfile.encoding=UTF8 -Duser.timezone=GMT -Djavax.servlet.request.encoding=UTF-8 \
       -Djavax.servlet.response.encoding=UTF-8 -Duser.timezone=GMT -Dorg.geotools.shapefile.datetime=true \
       -Dorg.geotools.shapefile.datetime=true -Ds3.properties.location=/opt/geoserver/data_dir/s3.properties "

apt update
apt install unzip -y
cd /usr/local/tomcat/webapps/geoserver/WEB-INF/lib
wget https://build.geoserver.org/geoserver/2.15.x/community-latest/geoserver-2.15-SNAPSHOT-geopkg-plugin.zip
unzip -o geoserver-2.15-SNAPSHOT-geopkg-plugin.zip

## Preparare the JVM command line arguments
export JAVA_OPTS="${JAVA_OPTS} ${GEOSERVER_OPTS}"

/scripts/update_passwords.sh
exec /usr/local/tomcat/bin/catalina.sh run
