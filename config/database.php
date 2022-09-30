<?php

    return [
        "mysql1" => [
            "DB_CONNECTION" => (getenv("DB_CONNECTION_1") ? getenv("DB_CONNECTION_1") : "mysql1"),
            "DB_HOST" => (getenv("DB_HOST_1") ? getenv("DB_HOST_1") : "mysql"),
            "DB_DRIVER" => (getenv("DB_DRIVER_1") ? getenv("DB_DRIVER_1") : "mysql"),
            "DB_DATABASE" => (getenv("DB_DATABASE_1") ? getenv("DB_DATABASE_1") : "frame_sf"),
            "DB_USER" => (getenv("DB_USER_1") ? getenv("DB_USER_1") : "root"),
            "DB_PASSWORD" => (getenv("DB_PASSWORD_1") ? getenv("DB_PASSWORD_1") : "root"),
            "DB_CHARSET" => (getenv("DB_CHARSET_1") ? getenv("DB_CHARSET_1") : "mysql"),
            "DB_PORT" => (getenv("DB_PORT_1") ? getenv("DB_PORT_1") : "3306"),
        ],
        "mysql2" => [
            "DB_CONNECTION" => (getenv("DB_CONNECTION_2") ? getenv("DB_CONNECTION_2") : "mysql2"),
            "DB_HOST" => (getenv("DB_HOST_2") ? getenv("DB_HOST_2") : "mysql"),
            "DB_DRIVER" => (getenv("DB_DRIVER_2") ? getenv("DB_DRIVER_2") : "mysql"),
            "DB_DATABASE" => (getenv("DB_DATABASE_2") ? getenv("DB_DATABASE_2") : "frame_sf_2"),
            "DB_USER" => (getenv("DB_USER_2") ? getenv("DB_USER_2") : "root"),
            "DB_PASSWORD" => (getenv("DB_PASSWORD_2") ? getenv("DB_PASSWORD_2") : "root"),
            "DB_CHARSET" => (getenv("DB_CHARSET_2") ? getenv("DB_CHARSET_2") : "utf8"),
            "DB_PORT" => (getenv("DB_PORT_2") ? getenv("DB_PORT_2") : "3306"),
        ],
    ];
