# Lab 3 - Version Control Refresher and Hello World Web PHP App

## Version Control Refresher

Git has become almost the universal standard for modern software version control. If you haven't used it before or could use a refresher, this section includes links to useful guides and a stronly recommended interactive tutorial. You are strongly encouraged to at least complete the interactive tutorial.

* Interactive Tutorial: <https://learngitbranching.js.org/>
* Git resources from GitHub: <https://try.github.io/>
* Tutorial on using GitHub (not just git): <https://guides.github.com/activities/hello-world/>

Note that GitHub (which now offers free private repos without a paid account) is not the only web-based solution for hosting and managing software projects through git. BitBucket and GitLab (which you can also host and run in your own infrastructure) are popular alternatives. You should be using version control for any/all of your software projects and definitly always when more than one developer is contributing to the project.

## Setup

* First, stop your nginx service if it is still running: <code>sudo systemctl stop nginx</code>
* Then, install docker compose (a tool that manages multiple docker containers): <code>sudo apt install docker-compose</code>
* Clone this git repository: <code>git clone https://github.com/prog38263/lab3.git</code>
* Change into the root of the lab directory, where the docker-compose.yaml file is located: <code>cd lab3</code>
* Run the docker-compose command, which builds and starts the containers in the compose file: <code>sudo docker-compose up</code>
* The compose file should have started an nginx web server with PHP support.
* Browse to the IP address of your server (http://your-vm-ip-address). You should see a message and a link.
* You can stop the docker containers by hitting <code>ctrl + c</code> in the terminal where you started docker.

## Basic Form Processing in PHP

PHP (<https://www.php.net/>), which stands for PHP Hypertext Preprocessor, is an older but very prevalent web programming language. It's popularity is partially due to the lack of required secondary application server and the speed with which a basic dynamic website can be built. In this section you will build a simple dynamic page that is capable of responding to a form submitted by a user. The page will use sessions to track user data and will be self contained in a single html file.

1. Create a new html document in the <code>code</code> folder of the repository called basic.php (or copy your html template from lab 2, but change the filename to basic.php).

2. Before the first html tag in your basic.php file, insert the following:
<pre>
&lt;?php
 //Start the session
 session_start();
?&gt;
</pre>            

Notice that PHP commands are written inline with html tags into a single document. Sections of code to be interpreted by the PHP processor begin with "&lt;?php" and end with "?&gt;".

3. After the opening <code>&lt;body&gt;</code> tag, insert the following (note, this assumes you're using the bootstrap css framework, if you're not, you don't need to include the div tags.

<pre>
&lt;div class="container"&gt;
    &lt;h1&gt;Hello&lt;/h1&gt;
    &lt;p&gt;The time is &lt;?php echo date('Y-m-d H:i:s'); ?&gt;&lt;/p&gt;
&lt;/div&gt;
</pre>      

4. Next, you'll create a sample login form that accepts an email address and a password. Enter the following before the closing div tag, just after the php echo date command above.

<pre>
&lt;form action="" method="post"&gt;
    &lt;div class="form-group"&gt;
        &lt;label for="emailAddress"&gt;Email address&lt;/label&gt;
        &lt;input type="email" class="form-control" id="emailAddress" aria-describedby="emailHelp" placeholder="Enter email" name="emailAddress" /&gt;
        &lt;small id="emailHelp" class="form-text text-muted"&gt;We'll never share your email with anyone else.&lt;/small&gt;
    &lt;/div&gt;
    &lt;div class="form-group"&gt;
        &lt;label for="inputPassword"&gt;Password&lt;/label&gt;
        &lt;input type="password" class="form-control" id="inputPassword" name="inputPassword" /&gt;
    &lt;/div&gt;
    &lt;button type="submit" class="btn btn-primary"&gt;Submit&lt;/button&gt;
&lt;/form&gt;
</pre>
 
5. Note that the *action* attribute in the previous step's form tag is "". This is a shortcut to send the form to the current page for processing. 

6. Next, you'll create some code in the same document (thought this isan't always good practice but for this short example it will be okay) to process the form. Somewhere between the <code>&lt;head&gt;&lt;/head&gt;</code> tags at the top of your document, insert the opening and closing php tags, <code>&lt;?php ?&gt;</code>

7. Between the php tags you just created, add the following:

<pre>
//Form processor
//These are variables in php, notice that php is dynamically typed
$loggedin = false;
$msg = "";

//Is the user logged in?
if (isset($_SESSION['loggedin'])) {
    //The $_SESSION[] associative array is a collection of array values that will be
    //  preserved as long as the user's session is still active.
    $loggedin = true;

    //Note here that in PHP the . is a concatenation operator.
    $msg="&lt;span class=\"alert alert-info\"&gt;Welcome back ".$_SESSION['emai']."&lt;/span&gt;";
}
</pre>

The code above will check the session array to see if the key "loggedin" already has a value. It will be empty by default and will be populated later when we validate a user's login attempt.

8. To process the form submitted when the user clicks the submit button, we access the $\_POST associative array. Enter the following just after the code in the previous step.

<pre>
//Did we just get a POST request?
//The $_POST array contains the elements from the submitted form. The index for each element is the element's name attribute in the form.
if (isset($_POST['emailAddress'])  and isset($_POST['inputPassword'])){
    //Lame validation check
    if ($_POST['emailAddress'] == "testuser@test.com" and $_POST['inputPassword'] == "Password123!") {
        $loggedin = true;
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $_POST['emailAddress'];
        $msg="&lt;span class=\"alert alert-success\"&gt;Welcome back ".$_SESSION['email']."&lt;/span&gt;";
    } else {
        $loggedin=false;
        $msg="&lt;span class=\"alert alert-danger\"&gt;Invalid login credentials supplied.&lt;/span&gt;";
    }
}
</pre>

9. The final piece of code to add is a statement that will print the contents of the <code>$msg</code> variable that should either contain a login confirmation or an error message. This statement can be inserted anywhere in the body section of the html page:

<code>&lt;?php echo "&lt;p&gt;$msg&lt;/p&gt;";?&gt;</code>

10. Save your file. Visit the page in a browser (http://your-vm-ip-address/basic.php) and try out your login function. Debug and error messages for PHP files can be found in the web server's error log. 

If you'd like to learn more about PHP here are some useful resources:

PHP Tutorial from W3Schools <https://www.w3schools.com/php/>
PHP Official Documentation and Function Reference <https://secure.php.net/manual/en/>
Laravel, a popular PHP framework <https://laravel.com/>
CodeIgniter, another popular PHP framework <https://www.codeigniter.com/>
