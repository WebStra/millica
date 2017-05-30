<div class="first_slider">
    @foreach($slideHome as $item)
    <div class="slider_block">
         <img class="img-responsive" src="{{str_replace('\\','/',$item->image)}}" alt="">
    </div>
    @endforeach
</div>