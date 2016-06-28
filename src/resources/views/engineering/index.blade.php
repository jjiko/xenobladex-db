<h1>Engineering</h1>
<nav class="nav">
@foreach($results as $category)
        <a class="btn btn-primary" href="/g/xbx/db/engineering/cat/{{ str_slug($category->slug) }}">{{ $category->name }}</a>
@endforeach
</nav>