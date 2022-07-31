<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $subject }}</title>
    </head>
    <body>
        <h1>Ad Reminder</h1>
        <p>
            <strong>name:- </strong>{{ $user['name'] }} <br>
            <strong>email:- </strong>{{ $user['email'] }} <br>
        </p>
        <p>
            <strong>all your available ads:- </strong>
            @forelse ($user->ads as $ad)
                <strong>name:- </strong>{{ $ad['name'] }} <br>
                <strong>description:- </strong>{{ $ad['description'] }} <br>
                <strong>category:- </strong>{{ $ad['category']['name'] }} <br>
                <strong>tags:- </strong>
                @php
                    collect($ad['tags'])->pluck('name')->each(function($item){
                        echo $item;
                    });
                @endphp <br>
                <strong>start_date:- </strong>{{ $ad['start_date'] }} <br>
            @empty
                there is no ads
            @endforelse
        </p>
    </body>
</html>