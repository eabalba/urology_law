<footer>
    <div class="footer-main">
        <div class="footer-container">
            <div class="footer-inner footer-inner-left">
                <img src="<?php echo site_url() . '/wp-content/uploads/2022/11/Path-12.png'; ?>" alt="footer-logo"/>
            </div>

           
            <div class="footer-inner footer-inner-right">
                <nav role="navigation" aria-label="Footer Menu" class="footer-menu">
                    <?php wp_nav_menu( array( 
                        'theme_location' => 'footer-menu', 
                        'container' => '',
                        'link_after' => '<svg class="button-arrow" xmlns="http://www.w3.org/2000/svg" width="9.914" height="9.913" viewBox="0 0 9.914 9.913">
								<g id="Group_25" data-name="Group 25" transform="translate(-1134.77 718.703) rotate(-45)">
								  <path id="Path_28" data-name="Path 28" d="M-17795.164-23149.789v8h8" transform="translate(5097.541 -28645.58) rotate(-135)" fill="none" stroke="#2d2c2c" stroke-width="1"/>
								  <path id="Path_29" data-name="Path 29" d="M-17784.227-23144.789h-12.812" transform="translate(19101.133 23446)" fill="none" stroke="#2d2c2c" stroke-width="1"/>
								</g>
							  </svg>'
                    )); ?>
                    
                </nav>
              
            </div>    
        </div>
    </div>
</footer>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<?php wp_footer(); ?>

</body>
</html>