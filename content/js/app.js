
$(document).ready(function (){

        $('[data-tooltip="tooltip"]').tooltip(); 
		
		
		
     $('body').on('focus',".tanggal", function(){                     
                      $(this).datepicker({
                            format: " yyyy-mm-dd",
                            viewMode: "year",
                            autoclose:true,
                            todayHighlight:true,
                            language:'id',
                            calendarWeeks:false,
                            startView:0,
                            todayBtn: "linked"
                     });
               }); 

		 $('body').on('focus',".tanggal-year", function(){                     
                      $(this).datepicker({
                            format: " yyyy",
                            viewMode: "years",
                            minViewMode: "years",
                            autoclose:true,
                            todayHighlight:true,
                            language:'id',
                            calendarWeeks:false,
                            startView:0,
                            todayBtn: "linked"
                     });
               }); 
     
     //disable button enter in form search   
     $("form[name='search']").find("input[type='text']").keypress(function(e){
      return e.keyCode != 13;
     });
        
});