( function( $ ) {
    var triggerAnimation = {
        animation: null,
        timestamps: {
            menuOpens: 25,
            menuCloses: 101,
            triggerAppears: 107,
            menuClosesFinishes: 131,
            menuOpensFinishes: 75,
            lottieEnds: 151,
        },
        createAnimation: function(){
            this.animation = bodymovin.loadAnimation({
                container: document.getElementById('gen-navbar-trigger'), // Required
                path: `${wp_data.theme_uri}/assets/lottie/menu-trigger.json`, // Required
                renderer: 'svg', // Required
                loop: false, // Optional
                autoplay: false, // Optional
                name: "Menu trigger", // Name for future reference. Optional.
            });
            //this.animation.setSpeed(1.5);
            this.animation.setSpeed(2);
            this.playTriggerAppears();
        },
        playTriggerAppears: function(){
            this.animation.setCurrentRawFrameValue(this.timestamps.triggerAppears);
            this.animation.timeCompleted = this.timestamps.menuClosesFinishes;
            this.animation.play();
        },
        playMenuOpens: function(){
            this.animation.setCurrentRawFrameValue(this.timestamps.menuOpens);
            this.animation.timeCompleted = this.timestamps.menuOpensFinishes;
            this.animation.play();
        },
        playMenuCloses: function(){
            this.animation.setCurrentRawFrameValue(this.timestamps.menuCloses);
            this.animation.timeCompleted = this.timestamps.menuClosesFinishes;
            this.animation.play();
        },
        lapFinished: function(){
            //console.log(this.animation.timeCompleted, this.animation.currentFrame);
            //There is a bug at load that makes it stuck at 151, wich is the lottieEnds timestamp
            return this.animation.timeCompleted == this.animation.currentFrame || this.animation.currentFrame == this.timestamps.lottieEnds;
        },
    };

    var genNavbar = {
        triggerSelector: "#gen-navbar-trigger",
        itemsListSelector: ".gen-menu",
        menuSelector: "#gen-navbar-menu",
        backgroundSelector: ".desktop-menu-background",
        canBeTriggered: function(){
            return triggerAnimation.lapFinished();
        },
        menuIsActive: function(){
            return this.getMenu().hasClass('active');
        },
        isDesktop: function(){
            return window.innerWidth >= 992;
        },
        getDesktopBackground: function(){
            return $(`${this.menuSelector} ${this.backgroundSelector}`);
        },
        getMenu: function(){
            return $(this.menuSelector);
        },
        getItemsList: function(){
            return $(`${this.menuSelector} ${this.itemsListSelector}`);
        },
        getTrigger: function(){
            return $(this.triggerSelector);
        },
        openMenu: function(){
            let $menu = this.getMenu();
            if(this.isDesktop()){
                this.getItemsList().addClass('active');
                this.getDesktopBackground().addClass('active');
            }
            else{
                $menu.stop().slideDown();
            }
            $menu.addClass('active');
            triggerAnimation.playMenuOpens();
            this.getTrigger().addClass('active');
        },
        closeMenu: function(){
            let $menu = this.getMenu();
            if(this.isDesktop()){
                this.getItemsList().removeClass('active');
                this.getDesktopBackground().removeClass('active');
            }
            else{
                $menu.stop().slideUp();
            }
            triggerAnimation.playMenuCloses();
            $menu.removeClass('active');
            this.getTrigger().removeClass('active');
        },
        triggerMenu: function(){
            if(!this.canBeTriggered())
                return;

            if(this.menuIsActive())
                this.closeMenu();
            else
                this.openMenu();
        },
        attachToEvents: function(){
            this.getTrigger().click(function(){
                genNavbar.triggerMenu();
            });
        },
    };

    $(document).ready(function(){
        genNavbar.attachToEvents();
        triggerAnimation.createAnimation();
        //triggerAnimation.playTriggerAppears();
        //console.log(triggerAnimation.animation);
    });

} )( jQuery );
