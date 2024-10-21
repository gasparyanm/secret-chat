CREATE DATABASE IF NOT EXISTS secret_message_test;

CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'secret';

-- Grant privileges to the user
GRANT ALL PRIVILEGES ON *.* TO 'user'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;
