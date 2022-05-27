<!--
	ETML
	Auteur : Serghei Diulgherov
	Date : 06.05.2022
	Description : Recipe detail page
-->

<!-- ##### Breadcumb Area End ##### -->
<div class="receipe-post-area section-padding-80">
    <!-- Receipe Slider -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="receipe-slider owl-carousel">
                    <img src="resources/image/recipes/<?php print RECIPE[0]['recImage']?>" style="height: 600px; object-fit:cover;" alt="Meal image">
                </div>
            </div>
        </div>
    </div>
    <!-- Receipe Content Area -->
    <div class="receipe-content-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="receipe-headline my-5">
                        <h2>
                            <?php 
                                print RECIPE[0]['recTitle'];
                                foreach (CATEGORIES as $category)
                                {
                                    if ($category['idCategory'] == RECIPE[0]['fkCategory'])
                                    {
                                        print " - " . htmlspecialchars($category['catName']);
                                    }
                                } 
                            ?>
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="receipe-ratings text-right my-5">
                        <div class="ratings">
                            <?php
                                /* Calculating the average rating of the recipe and displaying it. */
                                if (count(RATINGS)>0){
                                    $totalRatings = array();
                                    foreach (RATINGS as $ratings)
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
                                            print '<a href="index.php?controller=recipe&action=detail&id=' . RECIPE[0]['idRecipe'] . '&setRating=' . $i .'"><i class="fa fa-star" aria-hidden="true"></i></a>';
                                        }
                                        else
                                        {
                                            print '<a href="index.php?controller=recipe&action=detail&id=' . RECIPE[0]['idRecipe'] . '&setRating=' . $i .'"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
                                        }
                                    }
                                }
                                else
                                {
                                    for ($i = 1; $i <= 5; $i ++)
                                    {
                                        print '<a href="index.php?controller=recipe&action=detail&id=' . RECIPE[0]['idRecipe'] . '&setRating=' . $i .'"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
                                    }
                                    print "<br>Cette recette n'a acune note pour le moment";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if (isset($_SESSION['isConnected']) && $_SESSION['isConnected']): ?>
                    <div class="col-12 col-lg-8">
                        <?php $steps = explode(".", RECIPE[0]["recPreparation"]); $counter = 0;?>
                        <?php foreach ($steps as $step): ?>
                            <!-- Single Preparation Step -->
                            <div class="single-preparation-step d-flex">
                                <h4><?php $counter++; print $counter; ?></h4>
                                <p><?php print $step?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <!-- Ingredients -->
                    <div class="col-12 col-lg-4">
                        <div class="ingredients">
                            <h4>Ingredients</h4>
                            <?php $ingredients = explode(",", RECIPE[0]["recIngredients"]); $counter = 0;?>
                            <?php foreach ($ingredients as $ingredient): ?>
                                <?php $counter++;?>
                                <!-- Custom Checkbox -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck<?php print $counter?>">
                                    <label class="custom-control-label" for="customCheck<?php print $counter?>"><?php print $ingredient?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == TRUE): ?>
                        <form action="index.php?controller=recipe&action=modify&id=<?php print RECIPE[0]['idRecipe']; ?>" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn delicious-btn mt-30" type="submit">Modifier</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="col-12">
                        <h2>Vous devez être connecté pour voir cette recette</h2>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-left">
                        <h3>Laissez un commentaire</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="contact-form-area">
                        <form action="index.php?controller=recipe&action=detail&id=<?php print RECIPE[0]['idRecipe']; ?>&comment=1" method="post">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <input type="text" class="form-control" name="name" placeholder="Nom">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <input type="email" class="form-control" name="email" placeholder="E-mail">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Sujet">
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn delicious-btn mt-30" type="submit">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>