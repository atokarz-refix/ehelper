jQuery(document).ready(function($){


    $('.rfx_select_radio_label input').click(function(){

        var attribute = $(this).attr('name').replace('clone_','attribute_');
        var value = $(this).val();
        var original_select = $('select[name="'+attribute+'"]');
        
        original_select.val(value);
        original_select.trigger('change');
    
    });
    

    function rfx_select_radio_default_selected(){
        $('table.variations select').each(function(){
            var default_selected = $(this).val();
            if(default_selected){
                var clone_select = $(this).attr('name').replace('attribute_','');
                $('.rfx_clone_select[select="'+clone_select+'"] input[value="'+default_selected+'"]').prop("checked", true);
            }
        });
    }


    function rfx_select_radio_selected_name(){

        $('.rfx_select_radio_label input:checked').each(function(){
            var title = $(this).closest('.rfx_select_radio_label').find('.podpis').text();
            $(this).closest('.rfx_clone_select').find('.rfx_chosen_title').text(title);
        });

    }//rfx_select_radio_selected_name()



    
    function rfx_check_select_radio_enabled_options(pa_attribute){
    
        var options = [];
        $('select#'+pa_attribute+' option').each(function(){
            options.push($(this).val());
        });
    
        $('.rfx_clone_select[select="'+pa_attribute+'"] .rfx_select_radio_label input').each(function(){
            var input_value = $(this).val();
            if($.inArray(input_value, options) === -1){
                $(this).closest('.rfx_select_radio_label').hide();
            }//if
        });

        rfx_select_radio_selected_name();
    }//rfx_check_select_radio_enabled_options()
    

    
    
    
    
    
    $(document).on('rfx_variation_changed',function(obj,var_id){
        // alert(var_id)
        console.log('triggered > rfx_variation_changed');
        rfx_check_select_radio_enabled_options('pa_kolor');
    });
    
    
    setTimeout(function(){
        rfx_select_radio_default_selected();
        rfx_check_select_radio_enabled_options('pa_kolor');
    },200);

});//jQUery