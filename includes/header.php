<?php if($_SESSION['login'])
{
?>
<section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <img src="assets/img/logo.png" alt="Logo" class="menu-logo">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>
                            <li><a href="issued-books.php">Issued Books</a></li>
                              <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">My Profile</a></li>
                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Change Password</a></li>
                                </ul>
                            </li>
                            <li><a href="logout.php">Logout</a></li>

                        </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php } else { ?>
            <section class="menu-section">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <img src="assets/img/logo.png" alt="Logo" class="menu-logo">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">                        
                          
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php#ulogin">Student Login</a></li>
                            <li><a href="librarianlogin.php">Librarian Login</a></li>
                            <li><a href="adminlogin.php">Admin Login</a></li>

                        </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <?php } ?>