<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    date_default_timezone_set('asia/bangkok');
    echo $timestamp = date('H:i:s');
    ?>

    <script>
    $(document).ready(function() {
    // setInterval(timestamp, 1000);
});

function timestamp() {
    $.ajax({
        url: '/check_status/timestamp.php',
        success: function(data) {
            $('#timestamp').html(data);
        },
    });
}
    </script>
</body>
</html>