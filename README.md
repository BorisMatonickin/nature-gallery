# PHP photo gallery website

This is simple photo gallery website created by implementing MVC architectural design and Domain Driven Design. 
These designs are great even for small and basic CRUD applications because they are great for separation of concerns. 
Model is divided on Domain Objects, Data Mappers and Services. This is the basic separation in DDD. Every application 
can easily and fast grow up into big project and implementing DDD gives high extensibility. Project is using 
[PHPMailer](https://github.com/PHPMailer/PHPMailer) and [Auryn](https://github.com/rdlowrey/auryn) dependency injector. 
Goal of the project is not to reinvent the wheel but the learning of programming backend support from scratch for websites 
using the best practices of OOP paradigm. It is long, sometimes frustrating process but in the end very worthwhile. Therefore 
the most of functionalities are created from scratch. The layout is simple because the emphasis is on the backup development learning.
The application's base functionalities are:

    -  register new user
	-  log in and log out the user
	-  uploading the image 
	-  view and comment the image
	-  browsing images by categories
	-  view the profile
	-  edit the profile info
	-  edit the image info
	-  send the email to the administrator using the contact form
	
Future modules which will be added: 

	-  rating system of the image
	-  user following system 
	-  user experience improvement using javascript
	
Mysqldump sql file with some prepopulated data for testing is included in the database folder. All users have the same password 
which is simply PASSWORD. In the config file database connection parameters should be changed to your environment. 
Application is developed on localhost and setted up as virtual host with URL http://nature.dev 

 ```

<VirtualHost nature.dev:80>
    ServerAdmin admin@nature.dev
    DocumentRoot "c:\\wamp\\www\\nature_gallery\\webroot\\"
    ServerName nature.dev
    ServerAlias nature.dev www.nature.dev
</VirtualHost> 

 ```


