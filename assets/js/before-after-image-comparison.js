jQuery(document).ready(function($) {
    const $slider = $('.an-addon-for-elementor-bf-slider');
    const $beforeImage = $('.an-addon-for-elementor-image-after');
    const $sliderLine = $('.an-addon-for-elementor-bf-slider-line');
    const $sliderButton = $('.an-addon-for-elementor-bf-slider-button');
    const $comparison = $('.an-addon-for-elementor-image-comparison');
    
    // Set initial position
    if ( $slider.length ) {
        updateSliderPosition($slider.val());
    }
    
    // Update on input
    $slider.on('input', function() {
        updateSliderPosition($(this).val());
    });
    
    // Make slider button draggable
    $sliderButton.on('mousedown', function(e) {
        e.preventDefault();
        $(document).on('mousemove', handleDrag);
        $(document).on('mouseup', stopDrag);
    });
    
    function handleDrag(e) {
        const rect = $comparison[0].getBoundingClientRect();
        const x = e.clientX - rect.left;
        const percentage = (x / rect.width) * 100;
        const clampedPercentage = Math.min(100, Math.max(0, percentage));
        $slider.val(clampedPercentage);
        updateSliderPosition(clampedPercentage);
    }
    
    function stopDrag() {
        $(document).off('mousemove', handleDrag);
        $(document).off('mouseup', stopDrag);
    }
    
    function updateSliderPosition(value) {
        $beforeImage.css('clip-path', "inset(0px 0px 0px "+ value +"%)");
        $sliderLine.css('left', value + '%');
        $sliderButton.css('left', value + '%');
    }
    
    // Touch support
    $sliderButton.on('touchstart', function(e) {
        e.preventDefault();
        $(document).on('touchmove', handleTouch);
        $(document).on('touchend', stopTouch);
    });
    
    function handleTouch(e) {
        const rect = $comparison[0].getBoundingClientRect();
        const x = e.originalEvent.touches[0].clientX - rect.left;
        const percentage = (x / rect.width) * 100;
        const clampedPercentage = Math.min(100, Math.max(0, percentage));
        $slider.val(clampedPercentage);
        updateSliderPosition(clampedPercentage);
    }
    
    function stopTouch() {
        $(document).off('touchmove', handleTouch);
        $(document).off('touchend', stopTouch);
    }
}); 