<!--
	ETML
	Auteur : Serghei Diulgherov
	Date : 06.05.2022
	Description : A form to connect to the website.
-->
<div class="contact-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                <!-- Checking if the user is connected or not. If he is, it will display a message saying
                that he is connected. If not, it will display a message saying that he is not
                connected. -->
                <?php if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == TRUE): ?>
                    <h3>Vous êtes connecté en tant que <?php print $_SESSION['connectedUser'] ?></h3>
                <?php else: ?>
                    <h3>Se connecter</h3>
                <?php endif ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="contact-form-area">
                    <?php if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == TRUE): ?>
                        <form action="index.php?controller=home&action=connect&connect=0" method="post">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button class="btn delicious-btn mt-30" type="submit">Se déconnecter</button>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <form action="index.php?controller=home&action=connect&connect=1" method="post">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn delicious-btn mt-30" type="submit">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>