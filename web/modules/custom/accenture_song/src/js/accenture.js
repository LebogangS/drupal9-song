(function ($, Drupal) {
    Drupal.behaviors.accentureSong = {
        attach: function (context, settings) {
            
            // $(".delete-single-product").on('click', function(event){
            //     var prod_id = $(this).attr("data");
            //     if(confirm(this.getAttribute('data-confirm'))) {
            //         $('#' + prod_id).hide();
                    
            //         $.ajax({
            //             url: "/jsonapi/node/product/" + prod_id,
            //             method: "DELETE",
            //             headers: {
            //                 "Accept": "application/json",
            //                 "Content-Type": "application/hal+json"
            //             },
            //             success: function(data, status, xhr) {
            //               debugger
            //             }
            //         });
            //     }
            // });
        }
    };
})(jQuery, Drupal);