<div class="container">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="single-contact-information mb-30">
                <p>
                    <?php
                        if (isset($_SESSION['error'])){
                            print $_SESSION['error']; 
                        }
                        else print "Aucune erreur pour le moment, bonne nouvelle :)";
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
    unset($_SESSION['error']);
?>