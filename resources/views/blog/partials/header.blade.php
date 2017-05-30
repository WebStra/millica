<section class="blog_title">
    <div class="container">
        <h3>{!! $meta->getMeta('blog_title') !!}</h3>
    </div>
    @if(Breadcrumbs::exists())
        <div class="container">
            {!! Breadcrumbs::render() !!}
        </div>
    @endif
</section>