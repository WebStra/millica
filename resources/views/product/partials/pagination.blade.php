@if ($products->lastPage() > 1)
    <div class="pagination">
        @for ($i = 1; $i <= $products->lastPage(); $i++)
                <a class="{{ ($products->currentPage() == $i) ? ' active' : '' }}" href="{{ $products->url($i) }}">{{ $i }}</a>
        @endfor
        <a class="{{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}"
           href="{{ $products->url($products->currentPage()+1) }}"><img src="/assets/images/icon/ic_arrow_page.png"
                                                                        alt=""></a>
    </div>
@endif

