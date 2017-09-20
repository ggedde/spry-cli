# SpryCli
Command Line Interface for Spry

# Installation

```
composer global require ggedde/spry-cli
```

REQUIRES:
* PHP 5.4+


# List of Commands and arguments:

## **clear** &nbsp; <sub><sup>[*object*]</sup></sub>

###### *Objects:*
 - *logs* - clears both API and PHP log files. Does not remove archived logs.

###### *Examples:*

	spry clear logs
	
## **component** &nbsp;<sub><sup>|</sup></sub>&nbsp; **c** &nbsp; <sub><sup>[*component*]</sup></sub>
Generate a new Component and add it to your component directory in psr-4 format

###### *Examples:*
	
	spry component SalesReps

## **hash** &nbsp;<sub><sup>|</sup></sub>&nbsp; **h** &nbsp; <sub><sup>[*value*]</sup></sub>
Hash a value that processes it using the salt in the config file.
###### *Examples:*
	  
	spry hash "something to hash 123"

## **help** &nbsp;<sub><sup>|</sup></sub>&nbsp; **-h** &nbsp;<sub><sup>|</sup></sub>&nbsp; **--help**  
Display Information about Spry-cli.
###### *Examples:*
	  
	spry help

## **init** &nbsp;<sub><sup>|</sup></sub>&nbsp; **i** &nbsp; <sub><sup>[*public_folder*]</sup></sub>
Initiate a Spry Setup and Configuration with a default project setup.

[public_folder] *(optional)* -  creates a folder of that name and adds a index.php pointer file
###### *Examples:*
	  
	  spry init
	  spry init public_html

## **migrate** &nbsp;<sub><sup>|</sup></sub>&nbsp; **m** &nbsp;<sub><sup>[*options*]</sup></sub>
Migrate the Database Schema.
###### *Options:*
  - *--dryrun* - Only check for what will be migrated and report back. No actions will be taken.
  - *--destructive* - Delete Fields, Tables and other data that does not match the new Scheme.
###### *Examples:*
	  
	  spry migrate
	  spry migrate --dryrun
	  spry migrate --destructive
	  
## **test** &nbsp;<sub><sup>|</sup></sub>&nbsp; **t** &nbsp;<sub><sup>[*test*] [*options*]</sup></sub>
Run a Test or all Tests if a Test name is not specified.

[*test*] - Name of a Test in configuration or json test data.  Leave out to run all tests in configuration.
###### *Options:*
  - *--verbose* - List out full details of the Test(s).
  - *--repeat* - Repeat the test(s) a number of times.
###### *Examples:*   

	  spry test
	  spry test --verbose
	  spry test test_123 --verbose --repeat 4
	  spry test '{"route":"/example/add", "params":{"name":"test"}, "expect":{"response_code": 2000}}'

## **version** &nbsp;<sub><sup>|</sup></sub>&nbsp; **v** &nbsp;<sub><sup>|</sup></sub>&nbsp; **-v** &nbsp;<sub><sup>|</sup></sub>&nbsp; **--version**  
Display the Version of the Spry Instalation.
###### *Examples:*
	  
	  spry version
