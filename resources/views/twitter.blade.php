<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url( '/' ) }}">Home</a>
            </li>
        </ul>
    </div>
</nav>
<br><br>

<div class="container">

    <form type="post" action="{{ route( 'post.tweet' ) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="text">Tweet text</label>
            <input type="text" name="tweet" class="form-control" id="text">
        </div>
        <div class="form-group">
            <label for="file">Upload Images</label>
            <input type="file" name="images[]" multiple class="form-control" id="file">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Create Tweet</button>
        </div>
    </form>
    @if( count( $errors->all() ) )
        @foreach( $errors->all()  as $error )
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endforeach
        @endif
    
    @if( count( $data ) )
        <ul class="list-group">

        @foreach( $data as $key => $tweet )
            <li class="list-group-item">
                <h6>{{ $tweet[ 'text' ] }}</h6>
                <i class="fa fa-heart" aria-hidden="true"></i> {{ $tweet[ 'favorite_count' ] }}
                <i class="fa fa-repeat" aria-hidden="true"></i> {{ $tweet[ 'retweet_count' ] }}
            </li>
            @if( ! empty( $tweet['extended_entities'] ) )

                @foreach( $tweet[ 'extended_entities' ][ 'media' ] as $i )
                        <img src="{{ $i[ 'media_url_https' ] }}" alt="" style="width: 100px; height: 100px;">
                    @endforeach
                @endif
            @endforeach

        </ul>
        @else
        <p>No Tweets Found</p>
    @endif
</div>
</body>
</html>