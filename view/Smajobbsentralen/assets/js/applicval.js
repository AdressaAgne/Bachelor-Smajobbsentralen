$(function(){
var inputTypes;
$('form').find('input').each(function(){
    
    inputTypes = $(this).attr('id');
    console.log(inputTypes);
});

});