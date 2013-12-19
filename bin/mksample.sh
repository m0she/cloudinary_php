APP_PATH=$(pwd)
BUILD_PATH=$(mktemp -d)
CAKE_URL=https://github.com/cakephp/cakephp/archive/2.4.3.tar.gz
CLOUDINARY_URL=https://github.com/cloudinary/cloudinary_php/archive/1.0.8.tar.gz
# TMP:
CLOUDINARY_URL=https://github.com/m0she/cloudinary_php/archive/debug.tar.gz

cd $BUILD_PATH
curl -Lfs $CAKE_URL | tar -xz
curl -Lfs $CLOUDINARY_URL | tar -xz
CAKE_DIR=$(echo cakephp-*)
CLOUDINARY_DIR=$(echo cloudinary_php-*)

# Make sample an app dir
mv $CLOUDINARY_DIR/samples/PhotoAlbumCake $CAKE_DIR/
# Put cloudinary_php general code in plugin's Lib
mv $CLOUDINARY_DIR/src/* $CLOUDINARY_DIR/cake_plugin/CloudinaryCake/Lib
# Put plugin in plugins dir
mkdir $CAKE_DIR/PhotoAlbumCake/Plugin
mv $CLOUDINARY_DIR/cake_plugin/* $CAKE_DIR/PhotoAlbumCake/Plugin

# Embed cloudinary settings
#echo '...' > cloudinary

# Configure database settings
