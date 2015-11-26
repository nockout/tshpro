
<?php  $id=$options['widget']['instance_title']?>
<?php if( $options['type']=="slideshow"):?>
<?php $i=0;?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  <?php foreach ($slides as $s):?>
    <li data-target="#carousel-example-generic" <?php if($i==0):?> class="active" <?php endif?> data-slide-to="<?php echo $i++?>">
    </li>
    <?php endforeach;?>
  </ol>

  <!-- Wrapper for slides -->
  <?php $i=0?>
  <div class="carousel-inner" role="listbox">
  <?php foreach ($slides as $s):?>
    <div class="item <?php if($i==0):?>active <?php endif?> ">

    <img src="<?php echo site_url('files/large/'.$s->filename);?>" alt="" align="middle"  style="width:100%">
	<div class="jumbotron sp-bg-wrap text-center frame license-bg carousel-caption">
				<div  class="container">
					<form method="get" action="<?php echo base_url('home/search')?>">
						<input type="hidden" value="0" name="cId" id="byCatSelect">
						<input type="hidden" value="" name="cName" id="byCatName">
	
						<div class="col-md-4 text-center">
								<h1>You are&nbsp;</h1>
						</div>
						<div class="hidden-xs"><br><br></div>
						<div class="input-group input-group-lg col-md-6">
						
							<input type="text" placeholder="what you wear!" name="search" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-primary" name="submit" type="submit">Go!</button>
							</span>
						</div>
				
					</form>
				</div>
			</div>    
      
      
    </div>
    <?php $i++?>
 <?php endforeach;?>
 
  </div>

  <!-- Controls -->
  <a class="left carousel-control <?php echo $id?>" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control <?php echo $id?>" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right " aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<style>
.frame {
    background: rgba(0, 0, 0, 0)  repeat fixed center top;
    color: #fff;
    padding-top: 30px;
    left: 0% !important;
   
}
</style>

<script type="text/javascript">

$('.carousel').carousel({
    interval: 3000
})

   
</script>
<?php else :?>

<?php $_splides=array_chunk($slides, 4);

	
?>

<div class="container no-padding">
    <div class="col-md-12 no-padding bx-viewport">
    	
            <div id="myCarousel<?php echo $id?>" class="carousel slide">
             
                <!-- Carousel items -->
                <div class="carousel-inner">
                  <?php foreach ($_splides as $key=>$group):?> 
                    <div class="item <?php if($key==0) echo "active"?>">
                        <div class="row">
                        	<?php foreach ($group as $file):?>
                            <div class="col-sm-3"><a href="<?php echo $file->link?>">
                            <img src="<?php echo site_url('files/large/'.$file->filename);?>" alt="Image" class="img-responsive">
                            </a>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!--/row-->
                    </div>
               		
               		<?php endforeach;?>
                
                </div>
             	<a class="left carousel-control <?php echo $id?>" href="#myCarousel<?php echo $id?>" data-slide="prev">‹</a>
                <a class="right carousel-control <?php echo $id?>" href="#myCarousel<?php echo $id?>" data-slide="next">›</a>
            </div>
            <!--/myCarousel-->

    </div>
</div>

<script>
$(document).ready(function() {
	$('#myCarousel<?php echo $id?>').carousel({
	interval: 10000
	})
    
    $('#myCarousel<?php echo $id?>').on('slid.bs.carousel', function() {
    	//alert("slid");
	});
    
    
});


</script>
<style>

.carousel-control {
	left: -25px;
}
.carousel-control.right {
	right: -25px;
}

.carousel-indicators {
	right: 50%;
	top: auto;
	bottom: 0px;
	margin-right: -19px;
}

.carousel-indicators li {
	background: #c0c0c0;
}

.carousel-indicators .active {
background: #333333;
}
.bx-viewport {
    background: #fff none repeat scroll 0 0;
    border: 5px solid #fff;
    box-shadow: 0 0 5px #ccc;
    left: -5px;
    transform: translateZ(0px);
}
.no-padding{
	padding:0 !important;
}

.carousel-control {
    position: absolute;
   
    width: 40px;
    height: 40px;
    margin-top: 0;
    font-size: 60px;
    font-weight: 100;
    line-height: 30px;
    color: #ffffff;
    text-align: center;
    background: #222222;
   border: 3px solid #ffffff; 
     -webkit-border-radius: 23px; 
    -moz-border-radius: 23px;
     border-radius: 23px; 
    opacity: 0.5; 
    filter: alpha(opacity=50);
   
}
.carousel-control.popular{
		top:35%;
}
.carousel-control.frontend{
		top:50%;
}
.carousel-control.frontend.left{
		left:10%;
}
.carousel-control.frontend.right{
		right:10%;
}
</style>
<?php endif?>