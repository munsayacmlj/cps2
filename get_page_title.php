<?php 
		function get_page_title(){
			if (isset($_GET['new'])) {
				echo "New Arrivals";
			}

			if (isset($_GET['men'])) {
				if (isset($_GET['top']))
					echo "Tops for Men";
				else if (isset($_GET['bag']))
					echo "Bags for Men";
				else if(isset($_GET['shoe']))
					echo "Shoes for Men";
				else
					echo "Men";
			}

			if (isset($_GET['women'])) {
				if (isset($_GET['top']))
					echo "Tops for Women";
				else if (isset($_GET['bag']))
					echo "Bags for Women";
				else if(isset($_GET['shoe']))
					echo "Shoes for Women";
				else
					echo "Women";
			}

			if(isset($_GET['brand'])){

					foreach ($_GET as $key => $value){
						switch ($key) {
							case 'allen_edmonds':
								echo "Allen Edmonds";
								break;
							case 'balenciaga':
								echo "Balenciaga";
								break;
							case 'barba_napoli':
								echo "Barba Napoli";
								break;
							case 'berluti':
								echo "Berluti";
								break;
							case 'brioni':
								echo "Brioni";
								break;
							case 'christian_louboutin':
								echo "Christian Louboutin";
								break;
							case 'gucci':
								echo "Gucci";
								break;
							case 'jimmy_choo':
								echo "Jimmy Choo";
								break;
							case 'kate_spade':
								echo "Kate Spade";
								break;
							case 'manolo_blahnik':
								echo "Manolo Blahnik";
								break;
							case 'ralph_lauren':
								echo "Ralph Lauren";
								break;
							case 'saint_laurent':
								echo "Saint Laurent";
								break;
							case 'savatore_ferragamo':
								echo "Salvatore Ferragamo";
								break;
							case 'stuart_weitzman':
								echo "Stuart Weitzman";
								break;
							case 'versace':
								echo "Versace";
								break;
							default:
								# code...
								break;
						}
					}	
				
			}
		}
?>