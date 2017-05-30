<div id="search_bar" class="search_bar" style="display: none">
    <form action="{{route('data_search')}}" method="get">
        <input type="text" name="search" placeholder="{!! $meta->getMeta('search_text') !!}" value="{{old('search')}}">
    </form>
    <a href="" class="open_search_input">&times;</a>
</div>