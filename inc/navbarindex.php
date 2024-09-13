<nav class="navbar" style="position: fixed; top:0; width: 100%; z-index: 7;">
    <?php
    if (isLoggedIn() != true) {
        echo "<a href='../index.php' class='title' :hover :nav>";
    } else {
        echo "<a href='../dashboard.php' class='title' :hover :nav>";
    }
    ?>
        <span style="margin-left:155px">Apiary</span>
    </a>
    <ul class="nav-links">
        <div class="menu">
            <li><a href="../index.php" target="_blank">Home</a></li>
            <li><a href="#features-section">Features</a></li>
            <li><a href="#about-section">About</a></li>
            <?php
                if(isLoggedIn() != true){
                // NOT LOGGED IN
                echo "<li><a href='../new-employee.php'>Signup</a></li>
                    <li><a href='../login.php'>Login</a></li>";
                }           
            ?>
        </div>
        <div class="menu-mobile">
            <li class="services">
                <img class="menu-btn" src="../img/menu-btn.png" alt="dropdown button"/>
                <ul class="dropdown">
                    <div class="dropdown-arrow-up"></div>
                    <li><a href="../index.php" target="_blank">Home</a></li>
                    <li><a href="#features-section">Features</a></li>
                    <li><a href="#about-section">About</a></li>
                    <?php
                        if(isLoggedIn() != true){
                        // NOT LOGGED IN
                        echo "<li><a href='../new-employee.php'>Signup</a></li>
                            <li><a href='../login.php'>Login</a></li>";
                        }           
                    ?>
                </ul>
            </li>
            
        </div>
    </ul>
</nav>