<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('35d969b73948d5bdd755', {
            cluster: 'eu'
            });

            var channel = pusher.subscribe('channel_1_1');
            channel.bind('channel-message', function(data) {
            alert(JSON.stringify(data));
            });
        </script>
    </head>
    <body>
        Co
    </body>
</html>