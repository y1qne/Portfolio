<div class="d-flex justify-content-center container_post_tweet">
    <div class="col-lg-8 col-md-10 col-sm-12 post_tweet">
        <form action="./controllers/post_tweet.controller.php" method="POST" class="form_post_tweet">
            <input name="id" value="<?= $_SESSION["id"] ?>" hidden>
            <div class="mb-3">
                <input type="text" class="form-control" id="texte" name="texte" placeholder="What's up?" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="location" name="location" placeholder="Where are you?" value="">
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg" value="">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Tweet</button>
            </div>
        </form>
    </div>
</div>