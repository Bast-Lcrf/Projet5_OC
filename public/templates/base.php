<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Manifest -->
    <link rel="manifest" href="public/site.webmanifest">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="public/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="public/favicon/favicon-32x32.png">
    <link rel="manifest" href="public/favicon/site.webmanifest">
    <link rel="mask-icon" href="public/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS -->
    <link rel="stylesheet" href="public/css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
        <!-- Navigation -->
        <div class="sidebar" style="z-index: 1;">
            <div class="logo_content">
                <div class="logo">
                    <i class='bx bxl-php' ></i>
                    <div class="logo_name">Blog</div>
                </div>
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <ul class="nav_list">
                <li>
                    <a href="index.php?home">
                        <i class='bx bx-home-alt-2' ></i>
                        <span class="links_name">Accueil</span>
                    </a>
                    <span class="tooltip">Accueil</span>
                </li>
                <li>
                    <a href="index.php?listArticles">
                        <i class='bx bx-book-open'></i>
                        <span class="links_name">Les Articles</span>
                    </a>
                    <span class="tooltip">Les Articles</span>
                </li>
                <li>
                    <a href="index.php?register">
                        <i class='bx bx-user-plus'></i>
                        <span class="links_name">Inscription</span>
                    </a>
                    <span class="tooltip">Inscription</span>
                </li>
                <li>
                <?php if($_SESSION): ?>
                <?php if($_SESSION['statut'] == 'ROLE_ADMIN'): ?>
                    <a href="index.php?dashboard">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                <?php endif; ?>
                <?php endif; ?>
                </li>
                <?php if($_SESSION): ?>
                    <li id="logOut" >
                        <a href="index.php?logOut">
                            <i class='bx bx-log-out'></i>
                            <span class="links_name">Déconnexion</span>
                        </a>
                        <span class="tooltip">Déconnexion</span>
                    </li>
                <?php else: ?>
                        <li>
                            <a href="index.php?logIn">
                                <i class='bx bx-log-in'></i>
                                <span class="links_name">Connexion</span>
                            </a>
                            <span class="tooltip">Connexion</span>
                        </li>
            </ul>
            <?php endif; ?>
            <?php if($_SESSION): ?>
                <div class="profile_user">
                    <div class="user">
                        <div class="user_details">
                            <i class='bx bx-user-check'></i>
                            <span class="user_name"><?php echo $_SESSION['pseudo']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="profile_content">
                <div class="profile">
                    <div class="profile_details">
                        <img src="public/svg/avatars.svg" alt="avatar">
                        <div class="name_job">
                            <div class="name">Bastien LECERF</div>
                            <div class="job">Développeur Web</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="home_content">
        <div class="content" style="z-index: -1;">
            <?= $content ?>
        </div>
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-3">
                        <div class="nav_social">
                            <h3>Réseaux Sociaux</h3>
                            <ul>
                                <li>
                                    <i class='bx bxl-linkedin-square'></i>
                                    <a href="#linkedin" target="blank">Linkedin</a>
                                </li>
                                <li>
                                    <i class='bx bxl-github'></i>
                                    <a href="https://github.com/Bast-Lcrf/Projet5_OC" target="blank">Github</a>
                                </li>
                                <li>
                                    <i class='bx bxl-instagram-alt' ></i>
                                    <a href="https://www.instagram.com/bast_lf/?theme=dark" target="blank">Instagram</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form_contact">
                            <h3>Me Contacter</h3>
                            <form action="index.php?contact" method="POST">
                                <div class="form_FullName">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingLastname" placeholder="text" name="lastName">
                                        <label for="floatingLastname">Nom</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingFirstname" placeholder="text" name="firstName">
                                        <label for="floatingFirstname">Prénom</label>
                                    </div>
                                </div>
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email">
                                        <label for="floatingEmail">Email</label>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" id="floatingMessage" placeholder="Leave a comment here" name="messageContact"></textarea>
                                        <label for="floatingMessage">Message</label>
                                    </div>
                                    <div class="buttonFormContact">
                                        <button class="btn btn-warning" type="reset">Reset</button>
                                        <button class="btn btn-success" type="submit">Envoyer</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3">
                        <div class="links_footer">
                            <h3>Liens Utiles</h3>
                            <ul>
                                <li><a href="index.php">Accueil</a></li>
                                <li><a href="public/images/CV.pdf" target="blank">Mon CV</a></li>
                                <li><a href="index.php?listArticles">Les Articles</a></li>
                                <li><a href="index.php?logOut">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <p>Copyright - Bastien LECERF - Développeur PHP/Symfony - 2022 - OpenClassRooms</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- Javascript -->
    <script>
        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>
</html>