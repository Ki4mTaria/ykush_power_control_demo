#!/bin/sh
SCRIPT_DIR=$(cd $(dirname $0);pwd);
php $SCRIPT_DIR/../src/php/ini/install.php $*;
