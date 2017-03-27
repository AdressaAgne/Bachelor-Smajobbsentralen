<input type="hidden" name="image" id="image" value="1">

@if(isset($selected))
<div class="col-12" id="select-open" style="background-image: url({{$selected->image()->small}})">Select Image</div>
@else
<div class="col-12" id="select-open" style="background-image: url()">Select Image</div>
@endif

<div class="image-selector">
    @foreach($media as $image)
        <div class="col-12">
            <div class="col-3 image-select" data-id="{{$image->id}}" data-src="{{$image->small}}" style="background-image: url({{$image->small}})"></div> {{$image->small}}
        </div>
    @endforeach
    
    <button class="btn" id="select-close">Close</button>
    
</div>


<script>
    var selector = document.querySelector(".image-selector");
    var images = document.querySelectorAll(".image-select");
    var close = document.querySelector("#select-close");
    var open = document.querySelector("#select-open");
    
    close.addEventListener("click", function(e){
        selector.style.display = "none";
        e.preventDefault();
        return false;
    });
    
    open.addEventListener("click", function(e){
        selector.style.display = "block";
        e.preventDefault();
        return false;
    });
    
    for(var i = 0; i < images.length; i++){
        images[i].addEventListener("click", function(){
            document.getElementById("image").value =  this.getAttribute("data-id");
            open.style.backgroundImage = "url("+this.getAttribute("data-src")+")";
            selector.style.display = "none";
        });    
    }
</script>