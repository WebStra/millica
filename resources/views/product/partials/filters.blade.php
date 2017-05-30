<form class="filtre" method="get">
    <div class="products_details">
        <div class="products_details_head hidden-xs">
            <span>{{$meta->getMeta('filter_title_size')}}</span>
        </div>

        <div class="products_details_body">
            <div class="selectBox visible-xs">
                <select>
                    <option>Sorteaza dupa marime</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div class="checkboxes">
                @foreach($viewSizes as $item)
                    <input type="checkbox" name="{{str_slug($item->title)}}" value="{{$item->title}}"
                           id="size{{str_slug($item->id)}}" {{(isset($_REQUEST[str_slug($item->title)])) ? 'checked' : ''}}>
                    <label for="size{{str_slug($item->id)}}"><span></span>{{$item->title}}</label>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
    <div class="products_details">
        <div class="products_details_head hidden-xs">
            <span>culoare</span>
        </div>
        <div class="products_details_body">
            <div class="selectBox visible-xs">
                <select>
                    <option>Sorteaza dupa culoare</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div class="checkboxes">
                @foreach($viewColors as $item)
                    <input type="checkbox" name="{{str_slug($item->title)}}" value="{{$item->title}}"
                           id="color{{str_slug($item->id)}}" {{(isset($_REQUEST[str_slug($item->title)])) ? 'checked' : ''}}>
                    <label for="color{{str_slug($item->id)}}"><span></span>{{$item->title}}</label>
                    <br>
                @endforeach
            </div>
        </div>
    </div>

    <div class="products_details">
        <div class="products_details_head hidden-xs">
            <span>Pret</span>
        </div>
        <div class="switch">
            <input name="price" id="one" type="radio" value="100"/>
            <label for="one" class="switch__label">100</label>

            <input name="price" id="two" type="radio" value="200"/>
            <label for="two" class="switch__label">200</label>

            <input name="price" id="three" type="radio" value="300"/>
            <label for="three" class="switch__label">300</label>

            <input name="price" id="four" type="radio" value="400"/>
            <label for="four" class="switch__label">400</label>

            <input name="price" id="five" type="radio" value="500"/>
            <label for="five" class="switch__label">500</label>

            <div class="switch__indicator"></div>
        </div>
    </div>
</form>

