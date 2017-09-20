# SpryCli
Command Line Interface for Spry

# Installation

```
composer global require ggedde/spry-cli
```

REQUIRES:
* PHP 5.4+


# List of Commands and arguments:

## **clear** <sub><sup>[*object*]</sup></sub>

###### *Objects:*
 - *logs* - clears both API and PHP log files. Does not remove archived logs.

###### *Examples:*

	spry clear logs
	
## **component** | **c** <sub><sup>[*component*]</sup></sub>
Generate a new Component and add it to your component directory in psr-4 format

###### *Examples:*
	
	spry component SalesReps

## **hash** <sub><sup>|</sup></sub> **h** <sub><sup>[*value*]</sup></sub>
Hash a value that processes it using the salt in the config file.

###### *Examples:*
	  
	spry hash "something to hash 123"

## **help** &nbsp; <sub><sup>|</sup></sub>&nbsp;  **-h** <sub><sup>|</sup></sub>&nbsp;  **--help**  
Display Information about Spry-cli.

###### *Examples:*
	  
	spry help

## **init** | **i** &nbsp; <sub><sup> [*public_folder*]</sup></sub>
<sup>Initiate a Spry Setup and Configuration with a default project setup. </sup>
<sup>[public_folder] *(optional)* -  creates a folder of that name and adds a index.php pointer file</sup>
  
###### *Examples:*
	  
	  spry init
	  spry init public_html

## **migrate** | **m** &nbsp; <sub><sup> [*options*]</sup></sub>
<sup>Migrate the Database Schema.</sup>  
###### *Options:*
  - *--dryrun* - <sub><sup>Only check for what will be migrated and report back. No actions will be taken.</sup></sub>
  - *--destructive* - <sub><sup>Delete Fields, Tables and other data that does not match the new Scheme.</sup></sub>
  
###### *Examples:*
	  
	  spry migrate
	  spry migrate --dryrun
	  spry migrate --destructive
	  
## **test** | **t** &nbsp; <sub><sup> [*test*] [*options*]</sup></sub>
<sup>Run a Test or all Tests if a Test name is not specified.
 [*test*] - Name of a Test in configuration or json test data.  Leave out to run all tests in configuration.</sup>
###### Options:
  - *--verbose* - <sub><sup>List out full details of the Test(s).</sup></sub>
  - --repeat - <sub><sup>Repeat the test(s) a number of times.</sup></sub>
		
<sub>*examples:*</sub>   

	  spry test
	  spry test --verbose
	  spry test test_123 --verbose --repeat 4
	  spry test '{"route":"/example/add", "params":{"name":"test"}, "expect":{"response_code": 2000}}'

## **version** | **v** | **-v** | **--version**  
<sup>Display the Version of the Spry Instalation.</sup>
