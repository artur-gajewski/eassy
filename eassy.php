<?php

require 'vendor/autoload.php';

$twig = new Twig_Environment(
    new Twig_Loader_Filesystem('templates')
);

$json = file_get_contents('settings.json');
$settings = json_decode($json, true);

$hostsOutput = $twig->render(
    'hosts.template',
    array(
        'hosts' => $settings['Hosts']
    )
);

file_put_contents('output/hosts', $hostsOutput);


$appsMultipleOutput = $twig->render(
    'virtual_hosts.template',
    array(
        'server' => $settings['Server'],
        'apps' => $settings['Apps']
    )
);

file_put_contents('output/httpd-vhosts.conf', $appsMultipleOutput);

