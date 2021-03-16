
<?php 	
$products =  json_decode(file_get_contents('products.json'));
?>
		<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Products</title>
  </head>
  <body>
    <div class="container py-5">
    <h1 class="display-2 text-center mb-5">Products</h1>
    <div class="row">
    	<h2 class="h2 mb-0">
    		<?php  
    		$count  = count($products,COUNT_RECURSIVE);
				echo "Det finns: " .$count. " artiklar." ;
				#sort($products,SORT_STRING);	
				$pris = arsort($products);
				?>
    	</h2> 
    		
    		<?php 
    		usort($products, function($a,$b){
    			return $a->pris > $b->pris ? -1 : 1;
    		});?>
			<?php foreach ($products as $product):?>
    		
    		<?php
    			
    			$pris = round($product->pris*1.25);
    			$vikt = round($product->vikt);
    			$lagersaldo = round($product->lagersaldo);
    			

    			if(isset($product->artiklar_benamning))
				{
					$title = $product->artiklar_benamning;
				}
				else
				{
					$title = "N/A";
				}
				
				if(isset($product->artikelkategorier_id))
				{
					$Kategori = $product->artikelkategorier_id;
				}
				else
				{
					$Kategori = "N/A";
				}


    			if($lagersaldo <= 0)
    			{
    				
    				$lagersaldo = "Finns ej i lager.";
    				
    			}

    			?>




    		<div class="col-12 col-md-4">
    			<div class="card p-4 mb-5">
    				<h2 class="h3 mb-0">
    					<?php echo ucfirst($title);?>
    				</h2>
    				<p class="lead">
    					<?php echo ucfirst($Kategori);?>
    				</p>
    				<hr>
    					<ul class="list-unstyled">
    						<li>Pris: <?php echo $pris; ?>kr</li>
    						<li>Vikt: <?php echo $vikt;?>kg</li>
    						<li>Lagersaldo: <?php echo $lagersaldo;?></li>	
    					</ul>
    					<h3 class="h4">Detaljer</h3>
    					<p class="lead">
    						<?php echo ucfirst($product ->artiklar_variant);?>
    					</p>
    				</hr>
    		 	</div>
    		</div>
    	<?php endforeach; ?>
    </div>
</div> 
  </body>
</html>