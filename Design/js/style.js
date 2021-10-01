$(function(){

   // Calls the selectBoxIt method on your HTML select box
   $("select").selectBoxIt({

      // Uses the jQueryUI 'shake' effect when opening the drop down
      showEffect: "shake",
  
      // Sets the animation speed to 'slow'
      showEffectSpeed: 'slow',
  
      // Sets jQueryUI options to shake 1 time when opening the drop down
      showEffectOptions: { times: 1 },
  
      // Uses the jQueryUI 'explode' effect when closing the drop down
      hideEffect: "explode"
  
});

     //Hide placeholder   

     $('[placeholder]').focus(function(){
            $(this).attr('data-txt',$(this).attr('placeholder'));
            $(this).attr('placeholder','');

     }).blur(function(){
           $(this).attr('placeholder',$(this).attr('data-txt'));
     });

     //add asterisk for required input

     $('input').each(function(){
           if($(this).attr('required') === 'required'){
                 $(this).after('<span class="asterisk">*</span>');
           }            
     });
           
     // convert password to text
     var p=$('.pass');
     $('.show-pass').hover(function(){   
          p.attr('type','text');
     },function(){     
      p.attr('type','password');

     });

     // confirmation for delete any user from member

     $('.confirme').click(function(){
             
                return confirm("Are you sure to delete!!!");
     });
     
     // categories view option

     $('.categ h4').click(function(){
           $(this).next('.view').fadeToggle(200);
     });

     $('.order span').click(function(){
           $(this).addClass('active').siblings('span').removeClass('active');
           if($(this).data('view')==="Full"){
                 $('.categories .view').fadeIn(200);
           }
           else{
                  $('.categories .view').fadeOut(200);
           }
     });
     $(".refresh-categ").click(function(){
           window.location.href="categories.php";
     });
     $(".refresh-fourni").click(function(){
            window.location.href="fournisseurs.php";
      });
      $(".refresh-service").click(function(){
            window.location.href="services.php";
      });
      $(".refresh-produit").click(function(){
            window.location.href="produits.php";
      });
      $(".refresh-bon").click(function(){
            window.location.href="bons.php";
      });
      $("#datepicker").datepicker();
      $("#qte").change(function() {
            
            var qte=$("#qte option : selected").text();
            $("#qteresult").val(qte);
      
      });

});
