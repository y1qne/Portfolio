<?php require_once('./view_header.php'); ?>
<?php require_once('view_nav.php'); ?>

<body>
    <div class="container-fluid col-lg-6 col-md-9 col-sm-12">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
            <form class="card card-body" method="post" action="./controllers/edit_profil.controller.php" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo de profil:</label>
                    <?php if (!empty($id)) : ?>
                        <img src="./images/profil/<?php echo $id . ".png" ?>" alt="Photo de profil" style="max-width: 200px; max-height: 200px;" />
                    <?php endif; ?>
                    <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" required>
                </div>
                <div class="mb-3">
                    <label for="theme" class="form-label">Theme:</label>
                    <select class="form-select" name="theme" value="<?php echo $theme ?>">
                        <option value="1">pink</option>
                        <option value="2">red</option>
                        <option value="3">blue</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo:</label>
                    <input class="form-control" type="text" name="pseudo" placeholder="Pseudo" value="<?php echo $pseudo ?>">
                </div>

                <div class="mb-3">
                    <label for="alias" class="form-label">Alias:</label>
                    <input class="form-control" type="text" name="alias" placeholder="Alias" value="<?php echo $alias ?>">
                </div>

                <div class="mb-3">
                    <label for="pronouns" class="form-label">Pronouns:</label>
                    <select class="form-select" name="pronouns" value="<?php echo $pronouns ?>">
                        <option value="NULL">None</option>
                        <option value="she">She/Her</option>
                        <option value="he">He/Him</option>
                        <option value="they">They/Them</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">Birthdate:</label>
                    <input class="form-control" type="date" name="birthdate" placeholder="Birthdate" value="<?php echo $birthdate ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $email ?>">
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Bio:</label>
                    <input class="form-control" type="text" name="bio" placeholder="Bio" value="<?php echo $bio ?>">
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location:</label>
                    <input class="form-control" type="text" name="location" placeholder="Location" value="<?php echo $location ?>">
                </div>

                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="send" action="views/view_home.php" value="Submit">
                </div>

            </form>
        </div>
    </div>
</body>

</html>