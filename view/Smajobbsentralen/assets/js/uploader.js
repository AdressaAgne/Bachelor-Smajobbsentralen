// @codekit-prepend "prototype.js"

var info = 0;
function upload(files){
    
    ajax('admin/media', {
            file : files[0],
            '_token' : elm('[name=_token]').value,
            '_method' : elm('[name=_method]').value
    }, function(data){
        data = JSON.parse(data);
        
        if(isset(data.error)){
            window.console.log(data.error);
        } else {
            elm('#drop-container').style.backgroundImage = "url('"+data.folder+"')";
        }
    }, function(e){
        // Loading % text
        var p = Math.floor( (e.loaded / e.total) * 100 );
        if(info === 0){
            info++;
            elm('.info-text').textContent = "Uploading";
        }
        if(p >= 100){
            elm('.info-text').textContent = "Finished";
        }
        elm('[data-percent]').setAttribute("data-percent", p);
        elm('tspan').textContent = p+"%";
    });
    
}

elm("#drop-container").onDrop(function(files){
    if(files.length > 0) {
        upload(files);   
    }
}).onDragOver(function(){
    this.className = "drop active";
    
}).onDragLeave(function(){
    this.className = "drop";
    
});

elm("#file").addEventListener('change', function(){
    if(this.files.length > 0) {
        upload(this.files);
    }
});