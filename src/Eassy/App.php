<?php

namespace Eassy;

use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * An application class for Eassy
 *
 * Class App
 * @package Eassy
 */
class App
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var
     */
    private $settings;

    /**
     * @var
     */
    private $readOnly;

    public function __construct()
    {
        $this->twig = new Twig_Environment(
            new Twig_Loader_Filesystem('templates')
        );

        $json = file_get_contents('settings.json');
        $this->settings = json_decode($json, true);
    }

    /**
     * Run the app and generate the host and vhost files to the output folder
     *
     * @param bool $readOnly
     */
    public function run($readOnly)
    {
        $this->readOnly = $readOnly;

        $this->generateHostsFile();
        $this->generateApacheVirtualHosts();
        $this->generateApacheVirtualHostFiles();
    }

    /**
     * Generate /etc/hosts file contents
     */
    private function generateHostsFile()
    {
        $output = $this->twig->render(
            'hosts.template',
            array(
                'hosts' => $this->settings['Hosts']
            )
        );

        if ($this->readOnly === false) {
            file_put_contents('output/hosts', $output);
            echo 'Generated output/hosts' . PHP_EOL;
        } else {
            echo $output . PHP_EOL;
        }
    }

    /**
     * Generate httpd-vhosts.conf file contents
     */
    private function generateApacheVirtualHosts()
    {
        $output = $this->twig->render(
            'virtual_hosts.template',
            array(
                'server' => $this->settings['Server'],
                'apps' => $this->settings['Apps']
            )
        );

        if ($this->readOnly === false) {
            file_put_contents('output/httpd-vhosts.conf', $output);
            echo 'Generated output/httpd-vhosts.conf' . PHP_EOL;
        } else {
            echo $output . PHP_EOL;
        }
    }

    /**
     * Generate individual  file contents
     */
    private function generateApacheVirtualHostFiles()
    {
        foreach ($this->settings['Apps'] as $app) {
            $outputFile = $app['Description'];
            $outputFile = 'app-vhost-' . $this->slugify($outputFile);

            $output = $this->twig->render(
                $app['Template'] . '.template',
                array(
                    'app' => $app
                )
            );

            if ($this->readOnly === false) {
                file_put_contents('output/' . $outputFile, $output);
                echo 'Generated output/' . $outputFile . PHP_EOL;
            }
        }
    }

    /**
     * Generate slugified version of given string
     *
     * @param $text
     * @return mixed|string
     */
    function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text)) {
            return 'no-name-' . (time()*1000);
        }

        return $text;
    }
}