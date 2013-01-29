#!/bin/bash

dir=$(dirname $0)
php -f $dir/create_layout.php index.html main

exit 0
