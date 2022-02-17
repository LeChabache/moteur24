<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
<!-- Background of PhotoSwipe.
It's a separate element as animating opacity is faster than rgba(). -->
<div class="pswp__bg"></div>
<!-- Slides wrapper with overflow:hidden. -->
<div class="pswp__scroll-wrap">
    <!-- Container that holds slides.
        PhotoSwipe keeps only 3 of them in the DOM to save memory.
        Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <!--  Controls are self-explanatory. Order can be changed. -->
                <span style="color:white;position: relative;top: 9px;left: 10px;"><svg style="color:white;" class="cokQWN b1rIwt" viewBox="0 0 24 24" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" data-icon="true" data-testid="ImageIcon"><path fill="currentColor" d="M10 8.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path><path fill="currentColor" fill-rule="evenodd" d="M4.75 4h14.5A0.75 0.75 0 0120 4.75v14.5A0.75 0.75 0 0119.25 20H4.75A0.75 0.75 0 014 19.25V4.75A0.75 0.75 0 014.75 4zM5.5 16.88v1.62h13v-2.661l-4.778-4.778-3.039 3.038a0.75 0.75 0 01-1.06 0L8.95 13.428 5.5 16.879zm13-3.162V5.5h-13v9.258l2.921-2.92a0.75 0.75 0 011.06 0l0.672 0.67L13.19 9.47a0.75 0.75 0 011.061 0l4.248 4.248z" clip-rule="evenodd"></path></svg></span>
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="<?php _e( 'Close (Esc)', 'my-listing' ) ?>"></button>
                <button class="pswp__button pswp__button--share" title="<?php _e( 'Share', 'my-listing' ) ?>"></button>
                <button class="pswp__button pswp__button--fs" title="<?php _e( 'Toggle fullscreen', 'my-listing' ) ?>"></button>
                <button class="pswp__button pswp__button--zoom" title="<?php _e( 'Zoom in/out', 'my-listing' ) ?>"></button>
                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="<?php _e( 'Previous (arrow left)', 'my-listing' ) ?>">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="<?php _e( 'Next (arrow right)', 'my-listing' ) ?>">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>