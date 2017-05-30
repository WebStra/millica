<div class="container">
    <h3 class="title"><span>{{$meta->getMeta('colection_title')}}</span></h3>
    <div class="row">
        @foreach($colection as $item)
            <div class="col-sm-6">
                <div class="first_colection_block"
                     style="background: url({{str_replace('\\','/',$item->image)}}) no-repeat top center; background-size: cover;">
                    <span>{{$item->title}}</span>
                    <a href="{{route('get_colection',['colection'=>$item->id, 'title'=>str_slug($item->title)])}}">
                        <div class="first_colection_hover_block">

                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>