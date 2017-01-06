<div class="col-12">
    <a href="/page/edit/{{$page->permalink}}">edit</a>

    @form('/page/', 'delete')
        <input type="hidden" value="{{$page->id}}" name="id">
        <input type="submit" value="delete">
    @formend()

</div>
<article>
    <h1>{{ $page->header }}</h1>
    <p>{{ $page->content }}</p>
</article>