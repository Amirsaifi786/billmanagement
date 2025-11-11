<?php 


require'config.php';
 
if(isset($_REQUEST['track']))
{
      $track=$_REQUEST['track'];

}
 



include 'header.php';
?>


<section class="products-sec">
	<div class="container">
	    <div class="row">
      		<div class="col-lg-9 col-md-9 col-12">
    			<div class="products-main">
    				<div class="row g-2 ">
				    	<div class="products-title">
				    	    <h2>Search Result(s)</h2>
				    	</div>
                		<div class="row" id="dataget">
                 
                        </div>
                    </div>
                </div>
            </div>
	    </div>
	</div>
</section>
 

 
 

<?php include 'footer.php';?>

<script>
$(document).ready(function() {
 
        

        var start = "<?php echo $track; ?>";
    
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: { 
                start : start,
            },
            success: function(result) {
     
                if(result!='')
                {
                    
                    $('#dataget').html(result);
                }
            
           
            }
       
    });
});
</script>
 