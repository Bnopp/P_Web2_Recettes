<!--
	ETML
	Auteur : Serghei Diulgherov
	Date : 06.05.2022
	Description : Home Page
-->

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb4.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcumb-text text-center">
                    <h2>Bienvenue</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->
<div class="contact-information-area section-padding-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="logo mb-80">
                    <img src="resources/image/logos/logo.png" alt="logo">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="single-contact-information mb-30" styles="width: 100%;">
                    <h2>À propos</h2>
                    <p>La foire aux recettes est un site crée par des élèves apprentis de l'ETML afin de démontrer nos capacités en HTML, CSS, PHP et MySQL. 
                        Ce projet a été réalisé par Serghei Diulgherov, Timothée Carlier, Yannick Pena et Yann Imperadori avec Antoine Mveng en tant que chef de projet. 
                        Ce projet vise à mettre en oeuvre les connaissances acquises durant les modules 133 et 151 qui ce sont déroulés en parallèle du projet. 
                        Ce site vous permet de visualiser une variété de recettes séparées en différetes catégories ainsi que leurs attribuer une note et ajouter un commentaire. 
                        Vous avez aussi la possibilité de nous contacter directement sur la page concernée et nous ferons de notre mieux pour vous répondre. 
                        Soyez les bienvenus et n'hésitez pas à tester, jouer avec toutes les fonctionnalités du site et ainsi qu'à tester les recettes!
                    </p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-6">
                <h2>Recette la plus recente</h2>
                <div class="single-best-receipe-area mb-30">
                    <img src="resources/image/recipes/<?php echo RECIPE[0]['recImage']?>" style="height:300px; width:100%; object-fit:cover;"alt="Meal Image">
                    <div class="receipe-content">
                        <a href="index.php?controller=recipe&action=detail&id=<?php echo RECIPE[0]['idRecipe'] ?>">
                            <h5><?php echo RECIPE[0]['recTitle']?></h5>
                        </a>
                        <div class="ratings">
                            <?php
                                /* Calculating the average rating of the recipe and then printing
                                the stars. */
                                if (count(RATINGS[RECIPE[0]['idRecipe']])>0){
                                    $totalRatings = array();
                                    foreach (RATINGS[RECIPE[0]['idRecipe']] as $ratings)
                                    {
                                        foreach($ratings as $key => $value) 
                                        {
                                            array_push($totalRatings, $value);
                                        }
                                    }
                                    $ratingAVG = round(array_sum($totalRatings)/count($totalRatings), 0);
                                    for ($i = 1; $i <= 5; $i++)
                                    {
                                        if ($ratingAVG >= $i)
                                        {
                                            print '<i class="fa fa-star" aria-hidden="true"></i>';
                                        }
                                        else
                                        {
                                            print '<i class="fa fa-star-o" aria-hidden="true"></i>';
                                        }
                                    }
                                }
                                else
                                {
                                    print "Cette recette n'a acune note pour le moment";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>