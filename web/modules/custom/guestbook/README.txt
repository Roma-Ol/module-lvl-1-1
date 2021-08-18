Please, follow the instruction above in order to open the project correctly.

1.  $ cd *ur project directory*       		   // Be sure to run all the commands from the project root
2.  $ git pull origin tsk-5         		   // Pull the latest branch from the GitHub.
3.  Copy settings.local.php to web/sites/default // No explanation, just necessary
4.  Copy settings.php to web/sites/default       // No explanation, just necessary
5.  $ fin up         				   // Start project services
6.  $ fin composer install        	  	   // Install necessary dependencies.
7.  $ fin db import database.sql        	   // Import the database.
8.  $ fin drush cr        		   	   // Clear the cache.
9.  Follow http:module-lvl-0.docksal/romaroma/guestbook
10. Enjoy           			   	   // The most important part.

Currently, because of the AJAX, u`ll need to change ur cursor position twice (it`ll return back to its
postion after the first click). The problem itself lays in Entity API AJAX functionality and we all
hope that it`ll be fixed asap.

Also, bacause of the same problem with Entity API AJAX, u need to unfocus the field u`re trynna to
change while editing certain node, otherwise, no changes would be applied.