$(function(){
    $('.date-dropdown').change(function(){
        var fieldName = $(this).data('field');
        alert(fieldName);
    });
});