<?php
require_once("inc/global.php");
?>
<html>
    <head>
        <?php require_once("inc/head.php"); ?>
        <title>FAQ | Apiary Hives</title>
    </head>
    <body>

    <!--Navbar-->
    <?php
    if (isLoggedIn() != true) {
        require_once("inc/navbarindex.php");
    } else {
        require_once("inc/navbar.php");
    }
    ?>

    <!--Section: FAQ-->
    <div class="container">
    <br />
    <br />
    <br />

    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        This section contains questions related to the web application, <strong>ApiaryHives</strong>. If you cannot find an answer to your question, 
        please contact a member of our team.
    </div>

    <br />

    <div class="faq-page" id="accordion">
        <div class="faqHeader">Posting</div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">How do I make a post?</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="card-block">
                    To create a post, select the “+” button in the navigation bar and a post creation menu will appear, make sure “Post” is selected in the top left.
                    Utilize this feature to share fun or important moments with your coworkers and company.
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen">How do I make an announcement?</a>
                </h4>
            </div>
            <div id="collapseTen" class="panel-collapse collapse">
                <div class="card-block">
                    To create an announcement, select the “+” button in the navigation bar and an announcement creation menu will appear, make sure “Announcement” is selected in the top left.
                    Utilize this feature to share fun or important moments with your coworkers and company.
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">How do I like or comment on a post?</a>
                </h4>
            </div>
            <div id="collapseEleven" class="panel-collapse collapse">
                <div class="card-block">
                    When interacting with a post, you must first select the post to be brought to the “View Post” page.
                    From here you can comment and like or dislike the post by typing your comment and selecting “Save Comment” or selecting like or dislike.
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">How do I use the chat feature?</a>
                </h4>
            </div>
            <div id="collapseEleven" class="panel-collapse collapse">
                <div class="card-block">
                    When logged into the Dashboard, select the “Active Chats” dropdown under “Messaging” in the left sidebar.
                    This will show any chats you have and when clicked these chats will open a pop-up that will allow you to message.
                </div>
            </div>
        </div>

        <div class="faqHeader">Profile</div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">How do I edit my profile?</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="card-block">
                    When signed into the dashboard, hover over the hamburger menu icon, then select “Profile” to be redirected to the Profile page.
                    When on the Profile page, select the edit icon next to your username to be brought to the Account Details page. After editing your desired details, click the “Save Changes” button to save the new details.
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">How do I make an employee account?</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="card-block">
                    On the home page, select “Signup” and you will be brought to the employee account creation page.
                    </ul>
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">How do I make a company?</a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="card-block">
                    On the home page, select “Signup” in the navigation bar, then scroll to the bottom and select “Don’t have a company? Create one…”. This will bring you to the company creation page.
                    <br />
                </div>
            </div>
        </div>

        <div class="faqHeader">Reports and Tickets</div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">How do I submit a report to HR?</a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="card-block">
                    When logged into the Dashboard, select the triangle alert icon in the navigation bar.
                    This will take you to the “Report an Incident” page where you can fill out the form to alert your HR department.
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">How do I submit a ticket to IT?</a>
                </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse">
                <div class="card-block">
                When logged into the dashboard, select the computer icon in the navigation bar.
                This will take you to the IT report page where you may fill out a form to reach your IT department with your concerns.
                </div>
            </div>
        </div>

        <div class="faqHeader">Contacting Us</div>
        <div class="card ">
            <div class="card-header">
                <h4 class="card-header">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve">How do I get in contact with an ApiaryHives representative?</a>
                </h4>
            </div>
            <div id="collapseTwelve" class="panel-collapse collapse">
                <div class="card-block">
                You may reach an ApiaryHives creator or representative using the emails listed in the footer on the homepage.
                We’re happy to help and are always ready to hear your feedback.
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .faq-page{
        margin-bottom:100px;
    }
    .faqHeader {
        font-size: 27px;
        margin: 20px;
    }

    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        content: "e072"; /* "play" icon */
        float: right;
        color: #F58723;
        font-size: 18px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
</style>


    </body>
</html>