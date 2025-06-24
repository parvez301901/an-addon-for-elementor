jQuery(document).ready(function($){
  
  /*
  * Start Marquee
  */
  jQuery.map($('.ANAFE-marquee'), function( anafe_marquee, index ){
    let anafe_marquee_items = $('.ANAFE-marquee').eq(index).find('.ANAFE_marquee_items');
    let marquee_speed = anafe_marquee_items.attr('data-playspeed');
    let marquee_offsetwidth = anafe_marquee_items.width();
    let marquee_scrollWidth = anafe_marquee.scrollWidth;
    let position = 0;
    var current_width = ((marquee_scrollWidth - marquee_offsetwidth) / 2) + marquee_offsetwidth;
  
    function animate() {
      position -= marquee_speed;

      if (position < -current_width )  {
        position = current_width;
      }
      
      anafe_marquee_items.css('transform', `translateX(${position}px)`);
      requestAnimationFrame(animate);
    }
    
    animate();
  });
  /*
  * Start Marquee
  */
  
});