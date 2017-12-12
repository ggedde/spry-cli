# SpryCli
Command Line Interface for Spry

REQUIRES:
* PHP 5.4+

# Installation

```
composer global require ggedde/spry-cli
```

You also need to make sure you have the global composer bin available in your ~/.bash_profile or ~/.bashrc depending on what OS your using.

Edit one of those files and check to see if this exists.  If not then add it to the bottome of the file.

	export PATH="$PATH:$HOME/.composer/vendor/bin"

You may have to close and reopen your terminal or you can run

	source ~/.bash_profile
or

	source ~/.bashrc



## Create a project

	spry new [project_name]
	cd [project_name]

To Start the Test server run

	spry up

Then open another termal and run a test

	spry test


# List of Commands and arguments:

## **clear** &nbsp; <sub><sup>[*object*]</sup></sub>

[*object*] - Object name. Currently only supports 'logs'.
- *logs* - clears both API and PHP log files. Does not remove archived logs.

###### *Examples:*

	spry clear logs

## **component** &nbsp;<sub><sup>|</sup></sub>&nbsp; **c** &nbsp; <sub><sup>[*component*]</sup></sub>
Generate a new Component and add it to your component directory.

[*component*] - Name of component to create. Name will be parsed into psr-4 format.

###### *Examples:*

	spry component sales_reps
	spry component SalesReps

## **hash** &nbsp;<sub><sup>|</sup></sub>&nbsp; **h** &nbsp; <sub><sup>[*value*]</sup></sub>
Hash a value that processes it using the salt in the configuration.

[*value*] - Value to be hashed.  Wrap with quotes when including spaces.

###### *Examples:*

	spry hash "something to hash 123"

## **help** &nbsp;<sub><sup>|</sup></sub>&nbsp; **-h** &nbsp;<sub><sup>|</sup></sub>&nbsp; **--help**  
Display Information about Spry-cli.

###### *Examples:*

	spry help

## **init** &nbsp;<sub><sup>|</sup></sub>&nbsp; **i** &nbsp; <sub><sup>[*public_folder*]</sup></sub>
Initiate a Spry Setup and Configuration with a default project setup.

[*public_folder*] - *(optional)* -  creates a folder of that name and adds a index.php pointer file

###### *Examples:*

	  spry init
	  spry init public_html

## **logs** &nbsp;<sub><sup>|</sup></sub>&nbsp; **l** &nbsp; <sub><sup>[*type*]</sup></sub> &nbsp;<sub><sup>[*--options*]</sup></sub>
Display Contents of log files by type.

[*type*] - Type of logs to display. Corresponds to your configuration logs.
- *php* - Checks the php log file configured as $config->log_php_file.
- *api* - Checks the api log file configured as $config->log_api_file.

###### *Options:*
  - *--lines* - Default 100.  Number of lines to display.
  - *--trace* - Only applies to 'type=php'. Shows Trace in logs.

###### *Examples:*

	  spry logs api
	  spry logs php --lines 10 --trace

## **migrate** &nbsp;<sub><sup>|</sup></sub>&nbsp; **m** &nbsp;<sub><sup>[*--options*]</sup></sub>
Migrate the Database Schema.

###### *Options:*
  - *--dryrun &nbsp; | &nbsp;-d* &nbsp; - Only check for what will be migrated and report back. No actions will be taken.
  - *--force &nbsp; &nbsp; | &nbsp;-f* &nbsp; - (Destructive) Delete Fields, Tables and other data that does not match the new Scheme.

###### *Examples:*

	  spry migrate
	  spry migrate --dryrun
	  spry migrate --force

## **new** &nbsp;<sub><sup>|</sup></sub>&nbsp; **n** &nbsp;<sub><sup>[*project*]</sup></sub>
Create a new project/directory and initiate it.

[*project*] -  Name of project/directory to create and initialize.

###### *Examples:*

	  spry new project_name

## **test** &nbsp;<sub><sup>|</sup></sub>&nbsp; **t** &nbsp;<sub><sup>[*test*] &nbsp;[*--options*]</sup></sub>
Run a Test or all Tests if a Test name is not specified.

[*test*] - *(optional)* - Name of a Test in configuration or json test data.  Leave out to run all tests in configuration.

###### *Options:*
  - *--verbose* - List out full details of the Test(s).
  - *--repeat* - Repeat the test(s) a number of times.

###### *Examples:*   

	  spry test
	  spry test --verbose
	  spry test connection --verbose --repeat 4
	  spry test '{"route":"/example/add", "params":{"name":"test"}, "expect":{"response_code": 2000}}'

## **version** &nbsp;<sub><sup>|</sup></sub>&nbsp; **v** &nbsp;<sub><sup>|</sup></sub>&nbsp; **-v** &nbsp;<sub><sup>|</sup></sub>&nbsp; **--version**  
Display the Version of the Spry Instalation.

###### *Examples:*

	  spry version

## **up** &nbsp;<sub><sup>|</sup></sub>&nbsp; **u**
Start the built in PHP Spry Server.

###### *Examples:*

	  spry up
