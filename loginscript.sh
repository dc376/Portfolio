#!/bin/bash

mysqldump -u root -pchris --opt login > login.sql

sshpass -p chris scp login.sql 192.168.1.121:/home/dbbackup/backup
