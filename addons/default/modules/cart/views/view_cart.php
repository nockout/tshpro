<?php if ($this->go_cart->total_items()==0):?>
    <div class="alert alert-info">
        <a class="close" data-dismiss="alert">×</a>
        <?php echo lang('empty_view_cart');?>
    </div>
<?php else: ?>
    <div class="container" style="padding-top:10px;">
    <div class="page-header">
        <h2><?php echo lang('your_cart');?></h2>
    </div>
    <?php echo form_open('cart/update_cart', array('id'=>'update_cart_form'));?>
    
    <?php include('checkout/summary.php');?>

    <div class="row">
        
        
        <div class="col-md-7" style="text-align:right;">
                <input id="redirect_path" type="hidden" name="redirect" value=""/>
    

                <input class="btn btn-large btn-primary" type="submit" onclick="$('#redirect_path').val('cart/checkout');" value="<?php echo lang('form_checkout');?>"/>
       
            
        </div>
    </div>

</form>
</div>
<?php endif; ?>