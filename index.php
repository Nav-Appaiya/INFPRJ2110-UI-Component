<?php
    // Application entry point is now in:
    // Dir: web/app_dev.php for development
    // Dir: web/app.php for production

    // Please correct apache configuration for
    // webroot in /etc/apache2/sites-enabled/*
    // to point to /web/app.php

    header('Location: web/app_dev.php');