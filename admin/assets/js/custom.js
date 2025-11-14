(function ($) {
    "use strict";
    var mainApp = {
        slide_fun: function () {

            $('#carousel-example').carousel({
                interval:3000 // THIS TIME IS IN MILLI SECONDS
            })

        },
        dataTable_fun: function () {

            console.log('dataTable_fun called');
            console.log('jQuery version:', $.fn.jquery);
            console.log('dataTable function exists:', typeof $.fn.dataTable === 'function');
            console.log('Element #dataTables-example exists:', $('#dataTables-example').length > 0);

            try {
                if (typeof $.fn.dataTable === 'function' && $('#dataTables-example').length) {
                    console.log('Initializing DataTable');
                    $('#dataTables-example').dataTable();
                    console.log('DataTable initialized successfully');
                } else {
                    console.log('DataTable plugin not loaded or element not found, skipping initialization');
                }
            } catch(e) {
                console.error('DataTable initialization error:', e);
                // DataTables not loaded, skip
            }

        },
       
        custom_fun:function()
        {
            /*====================================
             WRITE YOUR   SCRIPTS  BELOW
            ======================================*/




        },

    }
   
   
    $(document).ready(function () {
        mainApp.slide_fun();
        mainApp.dataTable_fun();
        mainApp.custom_fun();
    });
}(jQuery));


