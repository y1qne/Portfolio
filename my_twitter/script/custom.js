$(document).ready(function () {
  $("#signup").click(function () {
    $("#main").load("./views/view_signup.php");
  });
  $("#login").click(function () {
    $("#main").load("./views/view_login.php");
  });

  $(".like-counter").each(function () {
    var cardId = $(this).closest('.card').attr('id');
    var likeCounter = $(this);

    $.post("./models/model_tweet_interactions.php", { id: cardId, action: "get_likes_count" }, function (response) {
      likeCounter.text(response.likes);
    }, "json").fail(function () {
    });
  });
  $(".btn_like").click(function () {
    var cardId = $(this).closest('.card').attr('id');
    var likeCounter = $(this).closest('.card').find('.like-counter');
    var btnLike = $(this).find('.fa-solid');
    if (btnLike.hasClass('liked')) {
      btnLike.removeClass('fa-heart-crack').addClass('fa-heart').removeClass('liked');
      $.post("./models/model_tweet_interactions.php", { id: cardId, action: "dislike" }, function (response) {
        likeCounter.text((response.likes));
      }, "json").fail(function (xhr, error) {
        console.log("Erreur de requête Ajax : " + error);
        console.log("Code de statut de la réponse : " + xhr.status);
        console.log("Message d'erreur de la réponse : " + xhr.statusText);
        console.log("Réponse du serveur : " + xhr.responseText);
      });
    } else {
      btnLike.removeClass('fa-heart').addClass('fa-heart-crack liked');
      $.post("./models/model_tweet_interactions.php", { id: cardId, action: "like" }, function (response) {
        likeCounter.text(response.likes);
      }, "json").fail(function (xhr, error) {
        console.log("Erreur de requête Ajax : " + error);
        console.log("Code de statut de la réponse : " + xhr.status);
        console.log("Message d'erreur de la réponse : " + xhr.statusText);
        console.log("Réponse du serveur : " + xhr.responseText);
      });
    }
  });



});

