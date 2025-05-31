<div class="header-nav-area header--sticky">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="nav-and-btn-wrapper">
                    <div class="nav-area">
                        <?php
                            wp_nav_menu([
                                'theme_location' => 'primary',
                                'container' => 'nav',
                                'container_class' => 'main-nav',
                                'menu_class' => 'parent-nav'
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>