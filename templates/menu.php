<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Prezentare proiect
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../pages/utilizationCasesPage.php">Cazuri de utilizere</a>
                        </li>
                        <li><a class="dropdown-item" href="../pages/dBModelPage.php">Modelarea bazei de date</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Utilizator
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        if (session_status() != PHP_SESSION_ACTIVE) {
                            session_start();
                        }
                        if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) { ?>
                            <li><a class="dropdown-item" href="../pages/accountCreationPage.php">Creare cont</a></li>
                            <li><a class="dropdown-item" href="../pages/accountConfirmationPage.php">Confirmare cont</a>
                            </li>
                            <li><a class="dropdown-item" href="../pages/loginPage.php">Autentificare</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="../pages/logoutPage.php">Deconectare</a></li>
                        <?php }
                        ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Pacient
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        if (session_status() != PHP_SESSION_ACTIVE) {
                            session_start();
                        }
                        if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]) { ?>
                            <li>
                                <a class="dropdown-item" href="../pages/programationsListPage.php">Programarile mele</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>