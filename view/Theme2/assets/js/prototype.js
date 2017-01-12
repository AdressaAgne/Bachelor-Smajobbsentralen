function elm(selector){
    return document.querySelector(selector);
}

HTMLElement.prototype.onDrop = function(func){
    this.addEventListener("drop", function(e){
        e.stopPropagation();
        e.preventDefault();
        
        if(typeof func === 'function'){
            var callback = func.bind(this);
            callback(e.dataTransfer.files);
        }
    }, false);
    
    return this;
};
HTMLElement.prototype.onDragOver = function(func){
    this.addEventListener("dragover", function(e){
        e.stopPropagation();
        e.preventDefault();
        
        if(typeof func === 'function'){
            var callback = func.bind(this);
            callback(e);
        }
    }, false);
    
    return this;
};
HTMLElement.prototype.onDragLeave = function(func){
    this.addEventListener("dragleave", function(e){
        e.stopPropagation();
        e.preventDefault();
        
        if(typeof func === 'function'){
            var callback = func.bind(this);
            callback(e);
        }
    }, false);
    
    return this;
};
// other events: error, abort
function ajax(url, data, load, progress){
    if(url === undefined){
        return null;
    }
    var formData = new FormData();
    
    for(var key in data){
        if(data.hasOwnProperty(key)){
            formData.append(key, data[key]);
        }
    }
    var XHR = new XMLHttpRequest();

    XHR.open('POST', url, true);
    if(load !== undefined && typeof load === 'function'){
        XHR.addEventListener("load", function(e){
            load(e.target.response);
        });
    }
    if(progress !== undefined && typeof progress === 'function'){
        XHR.upload.addEventListener("progress", function(e){
            if (e.lengthComputable) {
                progress(e);
            }
        });
    }
    
    XHR.send(formData === undefined ? null : formData);  
}

function isset(variable){
    return typeof variable !== 'undefined';
}