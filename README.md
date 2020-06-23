# xplor-toy-robot-php
PHP Test for Xplor

### Requirements
The commands I will be describing below, will work with a couple of things in mind:
1. You have installed **PHP** in your system (I am using version _7.4.7_) and you have added it to your PATH variables
2. You have installed **Composer** and added it to your PATH variables

### Installation
To get started, navigate to the **root** folder of the project and run:
- **composer install**

This will make sure you have installed **PHPUnit** for the testing (and all of it's requirements).

### Running the script
To start the script, run the following from the **root** of the project:
- **php src/main.php**

This will run the script, and now the command line awaits the user's input.

### Available commands
Once you run the script, you have 3 options:
1. Type **cli** to start giving the commands for the robot yourself, from the terminal.
2. Type **file** to read the commands from _src/commands.txt_ file (you can add all the commands you want here, one per line).
3. Type **exit** to exit the script.

With either **cli** or **file**, the commands you can use can be found here: [PROBLEM.md](PROBLEM.md)

### Testing
While on the **root** folder, and having used the command **composer install**, you should now be able to run the tests with:
- **./vendor/bin/phpunit tests** - This will run all the available tests.
