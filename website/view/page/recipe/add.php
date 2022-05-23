<!--
	ETML
	Auteur : Serghei Diulgherov
	Date : 06.05.2022
	Description : Add a recipe page
-->

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb4.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcumb-text text-center">
                    <h2>Ajouter une recette</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->
<div class="contact-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="contact-form-area">
                    <form action="index.php?controller=recipe&action=add&add=1" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <select class="selecting" name="select" id="select">
                                    <?php
                                        foreach (CATEGORIES as $category)
                                        {
                                            echo '<option value="' . htmlspecialchars($category['idCategory']) .'">' . htmlspecialchars($category['catName']) . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <input type="text" class="form-control" name="title" placeholder="Nom de la recette" required>
                            </div>
                            <div class="col-12">
                                <label>Veuillez séparer vos ingrédients par des virgules</label>
                                <input type="text" class="form-control" name="ingredients" placeholder="Ingrédients" required>
                            </div>
                            <div class="col-12">
                                <label>Veuillez séparer vos étapes de préparation par des points</label>
                                <textarea name="preparation" class="form-control" cols="30" rows="10" placeholder="Préparation" required></textarea>
                            </div>
                            <div class="col-12">
                                <label for="imgFile" class="btn">Select Image</label>
                                <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*">
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn delicious-btn mt-30" type="submit">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>