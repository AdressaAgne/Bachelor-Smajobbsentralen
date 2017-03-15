<?php

$db->createTable('kategorier', [
    new PID(),
    new Timestamp(),
    new Row('name', 'varchar'),
    new Row('icon', 'varchar'),
]);