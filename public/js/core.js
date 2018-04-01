$( document ).ready(function() {
    
    $('#datetimepicker').datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });
    
    
    (function checkStatus4() {
        if($("#status").val() == 4) {
            $('#status4').show();    
        }       
    })();
    
    $("#status").change(function(){
        console.log('тест');
        $('#status4').hide();
        if(this.value == 4){
            $('#status4').show();        
        }

    });
    
}); 