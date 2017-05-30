<div class="container">
    <h3>{!! $meta->getMeta('home_subscribe_title') !!}</h3>
    <h4>{!! $meta->getMeta('home_subscribe_text') !!}</h4>
    <div class="first_input_button">
        <form method="POST">
            {{csrf_field()}}
            <input type="text" name="email" placeholder="{!! $meta->getMeta('home_subscribe_email') !!}">
            <input class="subscribe_me" type="submit" value="{!! $meta->getMeta('home_subscribe_send') !!}">
        </form>
    </div>
</div>