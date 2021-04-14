<?php

if (isset($_GET['flux']) && !empty($_GET['flux'])) {
    $flux = htmlentities($_GET['flux']);
}