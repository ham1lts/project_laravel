#!/bin/bash

php-fpm82 -F &
nginx -g "daemon off;"
