<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('bootstrap')
    <title>FreeAds - Messagerie</title>
</head>
<body>
    @include('header_co')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="text-center">
                                    @if ($respond)
                                        Messages reçus
                                    @else
                                        Messages envoyés
                                    @endif
                                </h1>
                            </div>
                        </div>
                        <div class="row align-items-center ">
                            <div class="col ">
                                @if ($respond)
                                <a href="{{ route('messagerie') }}" class="btn btn-dark">Reçus</a>  
                                <a href="{{ route('envois') }}" class="btn btn btn-outline-dark">Envoyés</a>  
                                @else
                                <a href="{{ route('messagerie') }}" class="btn btn-outline-dark">Reçus</a>   
                                <a href="{{ route('envois') }}" class="btn btn-dark">Envoyés</a>    
                                                           
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        @foreach ($messages as $message)
                            @if ($message->status==0 && $respond)
                            <div class="card text-white bg-primary mb-3">
                            @else
                            <div class="card mb-3">
                            @endif
                                <div class="card-body">
                                    <h3 class="card-title">{{ $message->title }}</h3>
                                    <div>{{ $message->content }}</div>
                                    <div class="row mt-3">
                                        <div class="col-sm-9">
                                            <div class="font-weight-bold">{{ $message->name }}    -    {{ \Carbon\Carbon::parse($message->sent_at)->isoFormat('D MMMM YYYY') }}</div>
                                        </div>
                                    </div>
                                </div>
                                @if ($respond)
                                <div class="card-footer">
                                    <form action="{{ route('response',['annonce_id' => $message->annonce_id, 'receiver_id' => $message->sender_id]) }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" placeholder="Tapez votre réponse">
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-dark btn-block" type="submit">Envoyer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
