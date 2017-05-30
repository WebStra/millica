<?php $link = route('new_password', ['confirmation_code' => $user->verify_token]) ?>
        <!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{!! $meta->getMeta('password_new') !!}</h2>

<div>
    <p>{!! $meta->getMeta('password_link') !!} <a target="_blank" href="{{ $link }}">click!</a> </p>

</div>

</body>
</html>