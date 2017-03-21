$(function(){

$('form').find('input').each(function(){
    name = $(this).attr('name');
    console.log(name);
});

});