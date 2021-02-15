# Lab 8 - Open Redirection Vulnerability and PHP

## Setup

* git clone https://github.com/PROG38263-W21/Lab7.git
* cd Lab7
* docker-compose build && docker-compose up
* In a browser, navigate to the root directory of your virtual machine

## Exploitation

* Before logging in, try to access the secure.php page.
* The application will redirect the user to the login page. Note the extra GET parameter that the user will be redirected to after logging in.
* Try to craft a new URL with a different redirection GET parameter to a new URL, like https://www.google.com
* Visit the maliciously crafted link and login. You should be taken to the new URL.

