EASSY
=====

Eassy is an easy way to generate your /etc/hosts and apache virtual host files from a single JSON file.

Uses Twig templates for different virtual host settings to enable flexibility.

#Requirements

- PHP 5.3 or later
- Composer

#Installation from Github

Clone Eassy into your development environment.

    $ git clone git@github.com:artur-gajewski/eassy.git

Now go to your newly created directory.

Copy the distribution file for the settings to your local file:

    $ cp settings.json-dist settings.json

Modify the settings.json to reflect your virtual hosts.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    $ curl -s https://getcomposer.org/installer | php

Then, use the `install` command to install all dependencies:

    $ php composer.phar install

#Installing with Composer

Create a folder you want to install eassy to and inside it, create a 'composer.json' file. Now add the following to it:

    {
        "require": {
            "artur-gajewski/eassy": "dev-master"
        }
    }

Next, obtain Composer:

    $ curl -s https://getcomposer.org/installer | php

Finally, install eassy:

    $ php composer.phar install

# Generating output

After installing eassy, run the following command to display what will be generated:

    $ php eassy.php

when you are sure you want to generate the files, run:

    $ php eassy.php write

#Templates

Eassy uses Twig to generate templates for different app settings as different frameworks use different folder access
settings in virtual hosts. Each app has a setting variable called "Template" and it is the name of the template file
located in templates folder. By default there are default, Symfony2 and Zend Framework 2 templates available and you
are free to create more to suite your needs.

#Output

Output files and folders can be set in the Targets section of the JSON file. Following is an example of how you can
make Eassy generate files directly to be used by system:

    "Targets": {
        "HostsMapFile": "/etc/hosts",
        "ApacheVirtualHostsFile": "/etc/apache2/extra/httpd-vhosts.conf",
        "ApacheSingleVirtualHostFolder": "/etc/apache2/sites-available",
        "NginxSingleVirtualHostFolder": "/etc/nginx/sites-available"
    },

If any of these are empty or missing, system will use the following defaults:

- HostsMapFile: output/hosts
- ApacheVirtualHostsFile: output/httpd-vhosts.conf
- ApacheSingleVirtualHostFolder: output/apache
- NginxSingleVirtualHostFolder: output/nginx

#Upcoming features

- More framework templates
- PHAR file for the app

#Enjoy

Enjoy Eassy and if you have any ideas or concerns please do not hesitate to contact me!

Artur Gajewski

info@arturgajewski.com

Skype: artur.t.gajewski