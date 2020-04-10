#!/bin/bash

/opt/lampp/bin/mysql -uroot < ./app/database/db.sql && echo -e "\e[32;1mOK, bagus!\e[0m" || echo -e "\e[31mWoI : Waduch, terjadi kesalahan bung!\e[0m" && exit 1
