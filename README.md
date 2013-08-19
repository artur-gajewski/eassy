EASSY
=====

Eassy is an easy way to generate your /etc/hosts and apache virtual host files from a single JSON file.

#Requirements

- PHP 5.3 or later
- Composer

#Installation

Clone Eassy into your development environment.

    $ git clone git@github.com:artur-gajewski/eassy.git

Now go to your newly created directory.

Copy the distribution file for the settings to your local file:

    $ cp settings.json-dist settings.json

Modify the settings.json to reflect your virtual hosts.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    $ curl -s https://getcomposer.org/installer | php

Then, use the `install` command to install all dependancies:

    $ php composer.phar install

then run the following command:

    $ php eassy.php

#Templates

Eassy uses Twig to generate templates for different app settings as different frameworks use different folder access
settings in virtual hosts. Each app has a setting variable called "Template" and it is the name of the template file
located in templates folder. By default there are default, Symfony2 and Zend Framework 2 templates available and you
are free to create more to suite your needs.

#Output

Eassy will generate the following files to output folder:

- hosts - contains the host mappings, same as /etc/hosts
- httpd-vhosts.conf - Apache virtual hosts file

In addition, Eassy will create all virtual hosts settings in seperate files.
If you want the original files to be replaced by Eassy, you can create soft links in the output folder to
point to the original files.

#Enjoy

Enjoy Eassy and if you have any ideas or concerns please do not hesitate to contact me!

Artur Gajewski

info@arturgajewski.com

Skype: artur.t.gajewski