$(function(){
    $('.date-dropdown').change(function(){
        var fieldName = $(this).data('field');
        $('#date-dropdown-hidden-' + fieldName).val('');
        var day = $('#date-dropdown-day-' + fieldName).val();
        var month = $('#date-dropdown-month-' + fieldName).val();
        var year = $('#date-dropdown-year-' + fieldName).val();
        if(day && month && year) {
            $('#date-dropdown-hidden-' + fieldName).val(year + '-' + month + '-' + day);
        }
    });
});