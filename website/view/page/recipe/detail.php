<!-- ##### Breadcumb Area End ##### -->
<div class="receipe-post-area section-padding-80">
    <!-- Receipe Slider -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="receipe-slider owl-carousel">
                    <img src="resources/image/imgMainMeal/<?php print RECIPE[0]['image']?>" style="height: 400px; object-fit:cover;" alt="Meal image">
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
                        <h2><?php print RECIPE[0]['title']?></h2>
                        <div class="receipe-duration">
                            <h6>Prep: 15 mins</h6>
                            <h6>Cook: 30 mins</h6>
                            <h6>Yields: 8 Servings</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="receipe-ratings text-right my-5">
                        <div class="ratings">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="btn delicious-btn">For Begginers</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <?php $steps = explode(".", RECIPE[0]["preparation"]); $counter = 0;?>
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
                        <!-- Custom Checkbox -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">4 Tbsp (57 gr) butter</label>
                        </div>
                        <!-- Custom Checkbox -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">2 large eggs</label>
                        </div>
                        <!-- Custom Checkbox -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                            <label class="custom-control-label" for="customCheck3">2 yogurt containers granulated sugar</label>
                        </div>
                        <!-- Custom Checkbox -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                            <label class="custom-control-label" for="customCheck4">1 vanilla or plain yogurt, 170g container</label>
                        </div>
                        <!-- Custom Checkbox -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                            <label class="custom-control-label" for="customCheck5">2 yogurt containers unbleached white flour</label>
                        </div>
                        <!-- Custom Checkbox -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck6">
                            <label class="custom-control-label" for="customCheck6">1.5 yogurt containers milk</label>
                        </div>
                        <!-- Custom Checkbox -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck7">
                            <label class="custom-control-label" for="customCheck7">1/4 tsp cinnamon</label>
                        </div>
                        <!-- Custom Checkbox -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck8">
                            <label class="custom-control-label" for="customCheck8">1 cup fresh blueberries </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-left">
                        <h3>Leave a comment</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="contact-form-area">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <input type="email" class="form-control" id="email" placeholder="E-mail">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject">
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn delicious-btn mt-30" type="submit">Post Comments</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
