<article>
    <h3>{{ $page->header }}</h3>
    <p>@format($page->content)</p>
    @form("put")
    <div class="row">
        <div class="form-element col-6 col-s-12">

            <label> Fornavn
                <input type="text" name="swag"/>
            </label>
        </div>
        <div class="form-element col-6 col-s-12">
            <label> Etternavn
                <input type="text" name="swag"/>
            </label>
        </div>
        
    </div>
    @formend()
</article>