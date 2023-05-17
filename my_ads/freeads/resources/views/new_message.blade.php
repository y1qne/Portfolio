<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('bootstrap')
    <title>FreeAds - Message</title>
</head>
<body>
@include('header_co')

    <h1 class="text-center">Envoyer un message</h1>

    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <form action="{{ route('send_message',['annonce_id' => $annonce_id, 'receiver_id' => $receiver_id]) }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Message :</label>
                        <textarea class="form-control" id="message" name="content" rows="3"></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
