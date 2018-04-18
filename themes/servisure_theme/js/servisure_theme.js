/**
 * @file
 * Placeholder file for custom sub-theme behaviors.
 *
 */
(function ($, Drupal) {

  /**
   * Use this behavior as a template for custom Javascript.
   */
  Drupal.behaviors.exampleBehavior = {
    attach: function (context, settings) {
      //Main down arrow scrolling function in header
		$(".down-arrow").click(function() {
			$($(this).data("target"))
				$('html, body').animate({
		        scrollTop: $("#main").offset().top
		    }, 2000);
			

			});
    

  // Tiny jQuery Plugin
    // by Chris Goodchild
    $.fn.exists = function(callback) {
      var args = [].slice.call(arguments, 1);

      if (this.length) {
        callback.call(this, args);
      }
        return this;
    };

    $('.product-items-grid').exists(function(){
      
        var thisView = $('.views-element-container .left-callout-area');
        var thisButton = '<p class="button-container"><button class="view-all">View All Items</button></p>';

          thisView.append(thisButton);
        
         
          $(".view-all").click(function() {
            $($(this).data("target"))
            $('html, body').animate({
              scrollTop: $("#block-views-block-product-items-grid-block-1").offset().top
          }, 2000);

      });

    });


	//Navigation open and close
	$('#main-menu').on("click", function(){
		$('.left-off-canvas-menu').toggleClass("menu-open");
        if($('.left-off-canvas-menu').hasClass("menu-open")){
            $(".screen").fadeIn();
            } else {
              $(".screen").fadeOut();
            }
	});

	//Icon fonts js
	if (!('boxShadow' in document.body.style)) {
    document.body.setAttribute('class', 'noBoxShadow');
}

document.body.addEventListener("click", function(e) {
    var target = e.target;
    if (target.tagName === "INPUT" &&
        target.getAttribute('class').indexOf('liga') === -1) {
        target.select();
    }
});

(function() {
    var fontSize = document.getElementById('fontSize'),
        testDrive = document.getElementById('testDrive'),
        testText = document.getElementById('testText');
    function updateTest() {
        testDrive.innerHTML = testText.value || String.fromCharCode(160);
        if (window.icomoonLiga) {
            window.icomoonLiga(testDrive);
        }
    }
    function updateSize() {
        testDrive.style.fontSize = fontSize.value + 'px';
    }
    fontSize.addEventListener('change', updateSize, false);
    testText.addEventListener('input', updateTest, false);
    testText.addEventListener('change', updateTest, false);
    updateSize();
}());


    }
  };
//Magnific Pop-Up Settings
window.addEventListener("orientationchange", function(){
     if($('#cboxOverlay').is(':visible')){
        $.colorbox.load(true);
    }
}, false);

$('.form-display').on('click',function(){
  $(this).addClass('rotate');
  $('.contact-form').addClass('open');
});

jQuery('.close').on('click', function(){
jQuery('.alert-box .radius').hide(300);
});


})(jQuery, Drupal);
