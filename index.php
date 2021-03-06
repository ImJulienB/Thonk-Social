<?php
session_start();
?>
<html lang="fr">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Micro blog</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="css/freelancer.purified.min.css" rel="stylesheet">
        <link href="css/style.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php
            include 'php/database_connection.php';
        ?>
    </head>
    <body id="page-top" class="index">

        <!-- Navigation -->
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#page-top">Thonking media</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <?php
                            // Checking if you're connected.
                            // Step 1: making sure the variable exists.
                            if(isset($_SESSION["logged"])) {
                                // Step 2.1: if it does, checking if it equals true.
                                if ($_SESSION["logged"]) {
                                    ?>
                                    <!-- Step 2.2: you're connected, the website will show your username in the header... -->
                                    <li class="page-scroll">
                                        <a>Welcome, <?php echo $_SESSION["user"]; ?></a>
                                    </li>
                                    <!-- ...and a button to log out. -->
                                    <li class="page-scroll">
                                        <a href="./php/logout.php">Log out</a>
                                    </li>
                                    <?php
                                }
                            } else {
                                // Step 3.1: since you're not connected...
                                ?>
                                <li class="page-scroll">
                                    <!-- ...the website will show a button to log in... -->
                                    <a href="log_in.php">Log in</a>
                                </li>
                                <li class="page-scroll">
                                    <!-- ...or to sign in if you don't have an account. -->
                                    <a href="sign_in.php">Sign in</a>
                                </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- Header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-text">
                            <span class="name">Thonk social</span>
                            <img src="https://cdn.discordapp.com/emojis/371744933461229568.png" width="32px">
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section>
            <div class="container">
                <div class="row">
                    <?php
                        // Checking if you're connected: checking if the variable exists
                        if(isset($_SESSION["logged"])) {
                            // If logged in...
                            if($_SESSION["logged"]) {
                                // Show the message writing box
                            ?>
                            <form action="./php/message.php" method="post">
                                <div class="col-sm-10">  
                                    <div class="form-group">
                                        <textarea id="message" name="message" class="form-control" placeholder="What's up?" required></textarea>
                                        <!-- This hidden variable allows to send your username to the PHP script -->
                                        <input type="hidden" name="username" value="<?php echo $_SESSION["user"]; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success btn-lg">Send</button>
                                </div>
                            </form>

                            <!-- Image upload form, needs to be incorporated to the messages form -->
                            <form action="./php/image_upload.php" method="post">
                                <div class="col-sm-10">  
                                    <div class="form-group">
                                        <label for="filesToUpload">Select image to upload:</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                        <input type="submit" value="Upload Image" name="submit" class="btn btn-success btn-lg">
                                    </div>
                                </div>
                            </form>
                            <?php
                            }
                        }
                    ?>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php
                            // SQL stuff to grab the messages and their informations
                            while ($msg = $rqt->fetch(PDO::FETCH_ASSOC)) {
                                $mid = $msg['ID'];
                                $message = $msg['message'];
                                $date = $msg['date'];
                                $phpdate = strtotime( $date );
                                $date = date('d-m-Y H:m', $phpdate );
                                $auteur = $msg['user'];
                                $plusone = $msg['plusone'];

                                $message = preg_replace_callback("#(http(s|):\/\/([a-zA-Z0-9.-]{3,60})(\/|)([a-zA-Z0-9-._\/]+|))#",
                                                                function ($matches) {
                                                                    return "<a href='#'>{$matches[1]}</a>";
                                                                },
                                                                $message);
                                $message = preg_replace_callback("#@([a-zA-Z0-9-_]{2,60})#",
                                                                function ($matches) {
                                                                    return "<a href='#'>{$matches[0]}</a>";
                                                                },
                                                                $message);
                        ?>
                        <blockquote>
                            <span class='flex'>
                                <span>
                                    <!-- Showing the message author -->
                                    @<a href='#'><?php echo $auteur; ?></a>
                                </span>
                                <span>
                                    <?php
                                        // Checking if the user variable exists
                                        if (isset($_SESSION["user"])) {
                                            // Checking if you are the author of the message
                                            if ($_SESSION["user"] == $auteur) {
                                                // If yes: let's show you the edit and delete buttons
                                                ?>
                                                <a href='index.php?a=modif&id=<?php echo $mid; ?>' class='btn btn-secondary btn-sm'>Edit</a> <a href='./php/message.php?a=sup&id=<?php echo $mid; ?>' class='btn btn-danger btn-sm'>Remove</a>
                                                <?php
                                            }
                                        }
                                    ?>
                                </span>
                            </span>
                            <?php
                                // This is to check if you've clicked the edit button
                                if(isset($_GET['a'])) {
                                    if(isset($_GET['id'])) {
                                        // If yes, it grabs the ID of the message in order to know which message you want to edit
                                        if($_GET['id'] == $id) {
                                            // And if the ID is the message's ID: it show a text box with the message inside
                                            ?>
                                            <form action='./php/message.php' method='post' class='row'>
                                                <div class='col-sm-10'>
                                                    <textarea id='msgedit' name='msgedit' class='form-control' required><?php echo $message; ?></textarea>
                                                    <input type='hidden' name='id' value='<?php echo $id; ?>'>
                                                </div>
                                                <div class='col-sm-2'>
                                                    <button type='submit' class='btn btn-success btn-lg'>Send</button>
                                                </div>
                                            </form>
                                            <?php
                                            // The following line is in case the ID isn't correct
                                        } else echo "<p>$message</p>";
                                        // The following: if the ID variable does not exist in the GET method
                                    } else echo "<p>$message</p>";
                                    // The following: if the a variable does not exist in the GET method
                                } else echo "<p>$message</p>";
                                // Finally, showing the date in the footer of the message
                                echo "<h4><footer>+$plusone, <a class='plusOne' data-id='$mid'>+1 this post</a></footer></h4><footer>$date</footer></blockquote>";
                            }
                        ?>
                    </div>
                    <div class="center-a-btn">
                        <?php
                        if ($page > 1) {
                            ?><a href="?page=<?php echo $page - 1; ?>" id="nav-page" class="btn btn-primary btn-sm"><i class="zmdi zmdi-chevron-left"></i></a><?php
                        }

                        for ($i = 1; $i <= $nombreDePages; $i++) {
                            if ($page == $i) {
                                ?><a href="?page=<?php echo $i; ?>" id="nav-page" class="btn btn-success btn-sm"><?php echo $i; ?></a><?php
                            } else {
                                ?><a href="?page=<?php echo $i; ?>" id="nav-page" class="btn btn-secondary btn-sm"><?php echo $i; ?></a><?php
                            }
                        }

                        if ($page < $nombreDePages) {
                            ?><a href="?page=<?php echo $page + 1; ?>" id="nav-page" class="btn btn-primary btn-sm"><i class="zmdi zmdi-chevron-right"></i></a><?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>


        <!-- Footer -->
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-4">
                            <h3>Location</h3>
                            <p>3481 Melrose Place
                                <br>Beverly Hills, CA 90210</p>
                        </div>
                        <div class="footer-col col-md-4">

                        </div>
                        <div class="footer-col col-md-4">
                            <h3>About</h3>
                            <p>Thonk social is an open source PHP social network based on the <a href="https://startbootstrap.com/template-overviews/freelancer/">Freelancer</a> theme.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="facebook"></button>
                            <button class="youtube"></button>
                            <button class="twitter"></button>
                            <button class="linkedin"></button>
                            <button class="ripgoogleplus"></button>
                        </div>
                    </div>
                    <div class="row">
                        
                            Copyright &copy; Thonking Media 2018
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </body>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/freelancer.min.js"></script>
    <script src="js/plusone.min.js"></script>
</html>