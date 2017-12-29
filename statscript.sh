#!/bin/bash

mysqldump -u root -pchris --opt stats > stats.sql

sshpass -p chris scp stats.sql 192.168.1.121:/home/dbbackup/backup
