/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
	$('.treemap').hide();
    $('.treemap li').each(function(){
        if($(this).attr('class') !== 'active'){
        	$(this).hide();
            $(this).attr('class', 'inactive');
        }
    });
    $('ol').removeAttr('id');
     
    setTimeout(function(){
    	$('.treemap').show(500);	
    }, 500);
    $('ol').trigger('create'); 
});