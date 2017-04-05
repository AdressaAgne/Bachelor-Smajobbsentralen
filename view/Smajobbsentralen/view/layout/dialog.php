<div class="overlay"></div>
<div class="dialog">
    <div class="row">
        <div class="close">&times;</div>
        <div class="col-12">
            <p class="dialog--content">Empty Dialog</p>
        </div>
        <div class="col-12" id="dialog-buttons"></div>
    </div>
</div>
<script>
    var dialog_window = $('.dialog');
    var dialog_overlay = $('.overlay');
    var dialog_close = $(dialog_window).find('.close');
    var dialog_buttons = $('#dialog-buttons');
    
    function addButton(str){
        // create the button
        var btn = document.createElement('button');
        btn.setAttribute('id', 'button-'+str);
        btn.setAttribute('style', 'min-width: 100px;');
        btn.innerText = str;
        
        // crate a div
        var dialog_button = document.createElement('div');
        dialog_button.className = 'form-element form-element--right';
        dialog_button.setAttribute('style', 'margin-left: 10px;');
        dialog_button.innerHTML = btn.outerHTML;
        
        return dialog_button.outerHTML;
    }
    
    function hideDialog() {
        $(dialog_overlay).hide();
        $(dialog_window).hide()
    }
    
    function showDialog(str, callback) {
        $(dialog_window).find('.dialog--content').text(str);
        $(dialog_overlay).show();
        $(dialog_window).show();
        $(dialog_buttons).html('');
        
        //loop trho callback
        for (var key in callback) {
            
            // check if key exists
            if (!callback.hasOwnProperty(key)) continue;
            
            //generate btn html
            var btn_id = addButton(key);
            
            // add btn html to the dialog
            $(dialog_buttons).prepend(btn_id);
            
            //check if the callback is a function
            if(typeof callback[key] != 'function' || typeof callback[key] == undefined) {
                $('#button-'+key).click(hideDialog);    
                continue;
            }
            
            //add eventlistener to 
            $('#button-'+key).on('click', {callback : callback[key]}, function(e) {
                e.data.callback(e);
                hideDialog();
            }); 
        }
    }
    
    $(dialog_overlay).click(hideDialog);
    $(dialog_close).click(hideDialog);
    
</script>