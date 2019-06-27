var rbSliderTypes = {
    fixed:{
        id: 'fixed',
        adaptSlider(rbSlider, $slide, slideIndex, dontAnimate){},
    },
    adaptToContent: {
        id: 'adaptToContent',
        adaptSlider(rbSlider, $slide, slideIndex, dontAnimate){
            let $slidesContainer = rbSlider.getSlidesContainer();
            let slideHeight = $slide.outerHeight();
            let containerHeight = $slidesContainer.outerHeight();

            $slidesContainer.height(`${containerHeight}px`);
            if(dontAnimate){
                $slidesContainer.height(`${slideHeight}px`);
            }
            else{
                //console.log(rbSlider, $slide, slideIndex, dontAnimate);
                setTimeout(function(){
                    $slidesContainer.animate({
                        height: `${slideHeight}px`,
                    }, {
                        duration: rbSlider.config.animationDuration,
                        queue: false,
                    });
                }, 0);
            }
        },
    },
};

var rbSliderAnimations = {
    swipe: {
        id: 'swipe',
        goTo: function( rbSlider, $slide, slideIndex, dontAnimate ){
            let currentIndex = rbSlider.getCurrentIndex();
            let $currentSlide = rbSlider.getCurrentSlide();
            let $slidesContainer = rbSlider.getSlidesContainer();
            let isPrevious = slideIndex < currentIndex;
            let nextSlideOffset = $slide.offset();
            let slidesContainerOffset = $slidesContainer.offset();
            let displacement = isPrevious ? (slidesContainerOffset.left - nextSlideOffset.left) : -(nextSlideOffset.left - slidesContainerOffset.left);

            if(dontAnimate){
                $slidesContainer.css('left', `${displacement}px`);
            }
            else{
                $slidesContainer.stop().animate({
                    left: `${displacement}px`,
                }, {
                    duration: rbSlider.config.animationDuration,
                    queue: false,
                });
            }

            rbSlider.changeIndex(slideIndex);
            rbSlider.adaptSlider(slideIndex);
        },
    },
    fade: {
        id: 'fade',
        goTo: function( rbSlider, $slide, slideIndex, dontAnimate ){
            let $currentSlide = rbSlider.getCurrentSlide();
            let $slides = rbSlider.getAllSlides();

            $currentSlide.removeClass('active');
            $slide.addClass('active');
            if(dontAnimate){
                $currentSlide.css('opacity', 0);
                $slide.css('opacity', 1);
            }
            else{
                $currentSlide.stop().animate({
                    opacity: 0,
                }, rbSlider.config.animationDuration);

                $slide.stop().animate({
                    opacity: 1,
                }, rbSlider.config.animationDuration);
            }

            rbSlider.changeIndex(slideIndex);
            rbSlider.adaptSlider(slideIndex);
        },
    },
};

( function( $ ) {
    $(document).ready(function(){
        // =========================================================================
        // SLIDER
        // =========================================================================
        class RBSlider{
            constructor(id, config){
                this.id = id;
                this.$slider = $(`.rb-slider[rb-slider-id=${id}]`);
                this.defaults = {
                    type: rbSliderTypes.fixed,
                    animation: rbSliderAnimations.swipe,
                    animationDuration: 400,
                    goAround: true,
                    autoSlide: false,
                    autoDuration: 5000,
                };
                this.config = Object.assign({}, this.defaults, config);
                this.initialize();
            }

            // =====================================================================
            // GETTERS
            // =====================================================================
            getBullets( attrIndex ){
                return attrIndex ? $(`[rb-slider-link="${this.id}"][rb-slider-to=${attrIndex}]`) : $(`[rb-slider-link="${this.id}"][rb-slider-to]`);
            }

            getSlider(){
                return $(`.rb-slider[rb-slider-id=${this.id}]`);
            }

            getSlidesContainer(){
                let $slider = this.getSlider();
                return $slider.children('.rb-slides-container');
            }

            getSlide(index){
                return this.getSlidesContainer().children('.rb-slide').eq(index - 1);
            }

            getAllSlides(){
                return this.getSlidesContainer().children('.rb-slide');
            }

            getCurrentSlide(){
                return this.getSlide(this.getCurrentIndex());
            }

            getPrevSlide(){
                return this.getSlide(this.getPrevIndex());
            }

            getNextSlide(){
                return this.getSlide(this.getNextIndex());
            }

            isOnLastSlide(){
                return this.getSlidesAmount() == this.getCurrentIndex();
            }

            isOnFirstSlide(){
                return this.getCurrentIndex() == 1;
            }

            getCurrentIndex(){
                let $slider = this.getSlider();
                let index = $slider.length ? parseInt($slider.attr('rb-slider-index')) : 0;
                index = index ? index : 1;
                return index;
            }

            getNextIndex(){
                return this.isOnLastSlide() ? 1 : this.getCurrentIndex() + 1;
            }

            getPrevIndex(){
                return this.isOnFirstSlide() ? this.getSlidesAmount() : this.getCurrentIndex() - 1;
            }

            getSlidesAmount(){
                return this.getSlidesContainer().children('.rb-slide').length;
            }

            // =====================================================================
            // METHODS
            // =====================================================================
            goTo( index, dontAnimate ){
                let $slide = this.getSlide(index);
                //console.log(this.getSlider(), $slide, index);
                this.config.animation.goTo(this, $slide, index, dontAnimate);

                if( this.config.autoSlide ){
                    this.startAutoSlide();
                }
            }

            goToNext( ignoreGoAround ){
                if( !ignoreGoAround && ( !this.config.goAround && this.isOnLastSlide() ) )
                    return;
                this.goTo(this.getNextIndex());
            }

            goToPrev( ignoreGoAround ){
                if( !ignoreGoAround && ( !this.config.goAround && this.isOnFirstSlide() ) )
                    return;
                this.goTo(this.getPrevIndex());
            }

            changeIndex( newIndex, dontUpdateStatus ){
                let $slider = this.getSlider();
                if( $slider.length )
                    $slider.attr('rb-slider-index', parseInt(newIndex));
                if( !dontUpdateStatus )
                    this.updateStatus();
            }

            updateBullets(){
                let currentIndex = this.getCurrentIndex();
                let $bullets = this.getBullets();
                let $newActiveBullet = this.getBullets(currentIndex);
                $bullets.removeClass('active');
                $newActiveBullet.addClass('active');
            }

            updateSlidesStatus(){
                let $next = this.getPrevSlide();
                let $current = this.getCurrentSlide();
                let $prev = this.getNextSlide();

                if($next.length)
                    $next.removeClass('rb-next-slide rb-current-slide rb-prev-slide');
                if($current.length)
                    $current.removeClass('rb-next-slide rb-current-slide rb-prev-slide');
                if($prev.length)
                    $prev.removeClass('rb-next-slide rb-current-slide rb-prev-slide');

                if($next.length)
                    $next.addClass('rb-next-slide');
                if($current.length)
                    $current.addClass('rb-current-slide');
                if($prev.length)
                    $prev.addClass('rb-prev-slide');
            }

            updateLinkedIndexEl(){
                $(`[rb-slider-link="${this.id}"][rb-slider-index]`).text(this.getCurrentIndex());
            }

            updateStatus(){
                this.updateBullets();
                this.updateLinkedIndexEl();
                this.updateSlidesStatus();
            }

            adaptSlider( index, dontAnimate ){
                let $slide = this.getSlide(index);//console.log(dontAnimate);
                this.config.type.adaptSlider( this, $slide, index, dontAnimate );
            }

            setupAttributes(){
                let $slider = this.getSlider();
                if( $slider.length ){
                    $slider.attr('rb-slider-animation', this.config.animation.id);
                    $slider.attr('rb-slider-type', this.config.type.id);
                }
            }

            startAutoSlide(){
                var rbSlider = this;
                this.clearAutoSlide();
                this.autoslideInterval = setInterval(function(){
                    rbSlider.goToNext();
                }, this.config.autoDuration);
            }

            clearAutoSlide(){
                this.autoslideInterval = clearInterval(this.autoslideInterval);
            }

            // =====================================================================
            // INITIALIZE
            // =====================================================================
            initialize(){
                var rbSlider = this;
                var $slider = this.getSlider();

                $slider.attr('rb-slider-index', 1);
                this.setupAttributes();
                this.goTo(1, true);

                $(window).on('resize', function(){
                    let currentIndex = rbSlider.getCurrentIndex();
                    rbSlider.goTo(currentIndex, true);
                });

                $(`[rb-slider-link="${this.id}"][rb-slider-prev]`).click(function(){
                    rbSlider.goToPrev();
                });
                $(`[rb-slider-link="${this.id}"][rb-slider-next]`).click(function(){
                    rbSlider.goToNext();
                });
                $(`[rb-slider-link="${this.id}"][rb-slider-to]`).click(function(){
                    let index = parseInt($(this).attr('rb-slider-to'));
                    rbSlider.goTo(index);
                });
                this.updateLinkedIndexEl();

                if( this.config.autoSlide ){
                    this.startAutoSlide();
                }
            }
        }

        $('[rb-slider-id]').each(function(){
            let config = {};

            let typeAttr = $(this).attr('rb-slider-type');
            if( typeof typeAttr !== typeof undefined && typeAttr !== false )
                config.type = rbSliderTypes[typeAttr];

            let animationAttr = $(this).attr('rb-slider-animation');
            if( typeof animationAttr !== typeof undefined && animationAttr !== false )
                config.animation = rbSliderAnimations[animationAttr];

            let durationAttr = $(this).attr('rb-slider-duration');
            if( typeof durationAttr !== typeof undefined && durationAttr !== false )
                config.animationDuration = parseInt(durationAttr);

            let goAroundAttr = $(this).attr('rb-slider-goAround');
            if( typeof goAroundAttr !== typeof undefined && goAroundAttr !== false )
                config.goAround = goAroundAttr == 'true';

            let autoSlideAttr = $(this).attr('rb-slider-autoSlide');
            if( typeof autoSlideAttr !== typeof undefined && autoSlideAttr !== false )
                config.autoSlide = autoSlideAttr == 'true';

            let autoDurationAttr = $(this).attr('rb-slider-autoDuration');
            if( typeof autoDurationAttr !== typeof undefined && autoDurationAttr !== false )
                config.autoDuration = parseInt(autoDurationAttr);

            new RBSlider($(this).attr('rb-slider-id'), config);
        });

    });
} )( jQuery );
