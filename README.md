
## WebCrawler

This webcrawler is build with Laravel and supporting package from the community. It utilizes Inertia & Vue for the frontend and Laravel 10 for backend

The scope of this demostration is to go to a simple page, crawl there based on some element identifier there. This element will also have the link to navigate to different page on the site.  
We get html inline content from that single page, by visiting that url and save all the html in file with the Storage facility of Laravel.

## SETUP

- composer install.
- cp .env.example .env
- php artisan migrate if you have the a mysql running
- npm install & npm run dev
- php artisan serve
- php artisan storage:link
- http://127.0.0.1:8000/register
- after registration this process of crawling and will finish. 

## Thanks
