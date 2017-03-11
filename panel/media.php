@panel('layout.head', ['title' => 'Media'])
    <h1>Media</h1>
    <div class="row">
        <h3>Upload</h3>
        @form('', 'put')
        <section class="col-12" style="background-image: url('')">
            <label for="file" class="drop dropped" id="drop-container">
                <svg height="150" width="150" class="pie-chart" id="svg">
                    <circle class="behind"cx="50%" cy="50%" r="40%" />
                    <circle class="front" cx="50%" cy="50%" r="40%" data-percent="0" />
                    <text y="80" transform="translate(80)">
                       <tspan x="0" text-anchor="middle">0%</tspan>
                    </text>
                </svg>
                <span class="info-text">Klikk for a laste opp bilde</span>
            </label>
            <input type="file" id="file" hidden="">
        </section>
        @formend()
    </div>
    
    <div class="row">
       
        <h3>Your images</h3>
        @foreach($media as $image)
        
            <div class="col-3">
                
                <img src="{{$image->small}}" alt="">
                
            </div>
        
        @endforeach
        
    </div>
<script src="{{$assets}}/js/min/uploader-min.js"></script>   
@panel('layout.foot')