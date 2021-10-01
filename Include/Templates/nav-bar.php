
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button> 
        <a class="navbar-brand mb-0 h1" aria-current="page">FACULTÉ DES SCIENCES DHAR EL MAHRAZ</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="list-nav navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="fournisseurs.php">Fournisseurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produits.php">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bons.php">Bons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="etat.php">Etat d'annee</a>
                </li>
            </ul>
            <ul class="list-nav-profil nav navbar-nav navbar-right"> 
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                User 
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="edituser.php?do=Edit&Id=<?php echo $_SESSION['Id'] ?>">Edit Profile</a></li>
                    <li><a class="dropdown-item" href="setting.php?do=Setting&Id=<?php echo $_SESSION['Id'] ?>">Setting</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
                </li>
            </ul>
        </div>
  </div>
</nav>