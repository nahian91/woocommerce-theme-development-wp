<?php 
    global $redux_demo; 
    $msg1 = $redux_demo['header-msg-1'];
    $msg2 = $redux_demo['header-msg-2'];
    $logo = $redux_demo['logo'];
?>

<div class="header-top-area bg_primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bwtween-area-header-top">
                    
                        <?php if(!empty($msg1)) {
                            ?>
                            <div class="discount-area">
                                <p class="disc"><?php echo $msg1;?></p> 
                            </div>
                            <?php
                        } ?>

                        <?php if(!empty($msg2)) {
                            ?>
                            <div class="contact-number-area">
                                <p><?php echo $msg2;?></p>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>