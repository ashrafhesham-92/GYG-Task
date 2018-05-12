## **GetYourGuide! take-home test**

**Project structure**

 1. solution.php: the entry point of the application
 2. config.php: contains the application configuration
 3. autoloader: autoloads the application classes
 4. classes: folder that contains the application classes
 5. classes/helpers: folder contains Functions.php class that contains helper functions to be used in the application
 6. classes/services: folder contains the GuzzleHttpService.php class that is used as a wrapper for Guzzle package to make it easier making requests inside the application

**To start using the application:**

 1. open you terminal or cmd
 2. clone the project
 3. change directory to the project's directory
 4. run the following command `composer install`
 5. run the following command `php solution.php {start-time} {end-time} {travellers-number}`

**Making things clear:**
- I used composer as a dependency manager to include GuzzleHttp in my solution.
- I used Guzzle to make the request to the provided endpoint and retrieve the required data.
- I have created a wrapper for guzzle including a function for making GET requests to the provided endpoint and returns array representing the retrieved data.
- My solutions's entry point is the "solution.php" file which requires the autoload files and configuration files then instantiates an object of the "Application.php" class which is responsible of handling the logic of the solution.
- The "config.php" file is responsible of returning the configuration used inside the application, for example, using it makes me determine if the data will be retrieved from an API or a database connection, and based on that the logic is handled.
Also I used it to save the static endpoint to be used for retrieving data.
- The "Functions.php" class inside the classes/helpers directory is used to contain any functions that will be used to make small operations while I am working, for example, validating the date-time string format.


***If I had more time, I think that I will try  to find a better way to structure the final result to enhance the performance of the solution and think about scenarios that may make the logic of the solution fails at some point.***

I have really enjoyed working on that test and I hope that I get a feedback that guides me to know how to make me code better :)

Best regards,,