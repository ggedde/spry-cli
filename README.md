# SpryCli
Command Line Interface for Spry

## Installation

```
composer global require ggedde/spry-cli
```

REQUIRES:
* PHP 5.4+


## List of Commands and arguments:

**clear** [object]

- logs *(clears both API and PHP log files. Does not remove archived logs.)*




**component** | **c** [component]

*Generate a new Component and add it to your component directory.*

ex.
`spry component sales_reps`    (component classes will follow psr-4 format. ie SalesReps)




**hash** | **h** [value]

Hash a value that procedes it using the salt in the config file.

ex.
`spry hash "something to hash 123"`

help | -h | --help            - Display Information about Spry-cli.

init | i                      - Initiate a Spry Setup and Configuration with default project.
  ex.     spry init
  ex.     spry init public     (creates a folder called 'public' and an index.php pointer file)

migrate | m                   - Migrate the Database Schema.
  --dryrun                    - Only check for what will be migrated and report back. No actions will be taken.
  --destructive               - Delete Fields, Tables and other data that does not match the new Scheme.

test | t                      - Run a Test or all Tests if a Test name is not specified.
  --verbose                   - List out full details of the Test(s).
  --repeat                    - Repeat the test(s) a number of times.
  ex.     spry test
  ex.     spry test --verbose
  ex.     spry test test_123 --verbose --repeat 4
  ex.     spry test '{"route":"/example/add", "params":{"name":"test"}, "expect":{"response_code": 2000}}'

version | v | -v | --version  - Display the Version of the Spry Instalation.
