<!-- ##### Breadcumb Area Start ##### -->

<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Recettes</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <div class="receipe-post-area section-padding-80">
        <!-- Receipe Post Search -->
        <div class="receipe-post-search mb-80">
            <div class="container">
                <form action="index.php?controller=recipe&action=list" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <select name="select" id="select">
                                <option value="0">Toutes les recettes</option>
                                <?php
                                    foreach (CATEGORIES as $category)
                                    {
                                        echo '<option value="' . htmlspecialchars($category['idCategory']) .'">' . htmlspecialchars($category['catName']) . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-3 searchbar">
                            <input type="search" name="search" placeholder="Rechercher des recettes" >
                        </div>
                        <div class="col-12 col-lg-3 text-right">
                            <button type="submit" name="submit" class="btn delicious-btn searchBtn">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <?php if (count(RECIPES)>0): ?>
                    <?php foreach (RECIPES as $recipe): ?>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-best-receipe-area mb-30">
                                <img src="resources/image/recipes/<?php echo $recipe['recImage']?>" style="height:300px; width:100%; object-fit:cover;"alt="Meal Image">
                                <div class="receipe-content">
                                    <a href="index.php?controller=recipe&action=detail&id=<?php echo $recipe['idRecipe'] ?>">
                                        <h5>
                                            <?php 
                                            echo $recipe['recTitle']; 
                                            foreach (CATEGORIES as $category)
                                            {
                                                if ($category['idCategory'] == $recipe['fkCategory'])
                                                {
                                                    print " - " . htmlspecialchars($category['catName']);
                                                }
                                            } 
                                            ?>
                                        </h5>
                                    </a>
                                    <div class="ratings">
                                        <?php 
                                            if (count(RATINGS[$recipe['idRecipe']])>0){
                                                $totalRatings = array();
                                                foreach (RATINGS[$recipe['idRecipe']] as $ratings)
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
                    <?php endforeach ?>
                <?php else : print "<h3>Aucune recette ne correspond à votre recherche</h3>" ?>
                <?php endif ?>
            </div>
        </div>
    </div>