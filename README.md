# PageGenerator
Page Generator in PHP. Allow to generate the HTML code.


## How to use it ? 

It's simple, just add the class to your project, then include it where you want to use it (or via an autoload) :

    require_once 'path/to/the/class/Page.class.php
    
Then initialize a new variable :
    
    $myPage = new Page($title [, $charset = "UTF-8" [, $favicon = '' [, $defaultlib = true]]]);

*$defaultlib* allow to include a starterpack of libraries, frameworks... commonly used 
* Currently included :
  - Bootstrap : vers. 4.4.1
  - JQuery : vers. 3.4.1
  - Font-Awesome : vers. 5.8.1
