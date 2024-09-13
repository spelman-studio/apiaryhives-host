 <!--Navbar-->
<?php 
require_once("inc/global.php");

$user_id = (int) $_SESSION['loggedIn_userId'];
?>

<nav class="navbar" style="position: fixed; top:0; width: 100%; z-index: 1;">
    <a href="dashboard.php" class="title"><span class="apiary-label">Apiary</span></a>
    <ul class="nav-links">
        <div class="menu">
            <li><a href="help-page.php" target="_blank"><img class="help-button btn-#00000" src="../img/get-help-btn.png" alt="help button"/></a></li>
            <li><a href="new-ticket.php" target="_blank"><img class="ticket-btn" src="../img/it-report-btn.png" alt="ticket button"/></a></li>
            <li><a href="new-report.php" target="_blank"><img class="report-btn" src="../img/report-btn.png" alt="report button"/></a></li>
            <li><img src="../img/new-post-btn.png" alt="create post button" onClick="togglePopupPost()" class="create-post-img btn:hover"/></li>
            <li class="services">
                <img class="menu-btn" src="../img/menu-btn.png" alt="dropdown button"/>
                <ul class="dropdown">
                    <div class="dropdown-arrow-up"></div>
                    <li><a href="../user-profile.php?user_id=<?php echo $user_id ?>">Profile</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <?php
                        if(isLoggedIn()){
                            echo "<li><a href='/logout.php'>Sign Out</a></li>";
                        }
                    ?>
                </ul>
            </li>
        </div>
        <div class="menu-mobile">
            <li><img src="../img/new-post-btn.png" alt="create post button" onClick="togglePopupPost()" class="create-post-img btn:hover"/></li>
            <li class="services">
                <img class="menu-btn" src="../img/menu-btn.png" alt="dropdown button"/>
                <ul class="dropdown">
                    <div class="dropdown-arrow-up"></div>
                    <li><a href="help-page.php" target="_blank">FAQ</a></li>
                    <li><a href="new-ticket.php" target="_blank">New Ticket</a></li>
                    <li><a href="new-report.php" target="_blank">New Report</a></li>
                    <li><a href="../user-profile.php?user_id=<?php echo $user_id ?>">Profile</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <?php
                        if(isLoggedIn()){
                            echo "<li><a href='/logout.php'>Sign Out</a></li>";
                        }
                    ?>
                </ul>
            </li>
        </div>
    </ul>
</nav>