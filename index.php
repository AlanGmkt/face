<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>99Points.info :Fresh Tutorial: Facebook Like URL data Extract Using jQuery PHP and Ajax </title>

<link rel="stylesheet" href="css.css" type="text/css">
<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="jquery.livequery.js"></script>
<script type="text/javascript" src="jquery.watermarkinput.js"></script>
</head>
<script type="text/javascript">
	// <![CDATA[	
	$(document).ready(function(){	
		// delete event
		$('#url').keypress(function(e){
			var tecla=e.which; 
			if(tecla==32){
			     texto=$('#url').val();
				 cadenas=texto.split(' ');
				 posicion=cadenas.length;
				if(!isValidURL(cadenas[posicion-1])){
					
					}else{
							$('#url').livequery(function(){
									if(!isValidURL(cadenas[posicion-1]))
									{
										alert('Please enter a valid url.');
									}
									else
									{
										var url="http://"+cadenas[posicion-1];
										$('#load').show();
										$.post("fetch.php?url="+url, {
										}, function(response){
											$('#loader').html($(response).fadeIn('slow'));
											$('.images img').hide();
											$('#load').hide();
											$('img#1').fadeIn();
											$('#cur_image').val(1);
										});
									}
								});	
						}
			}
	});
		
		// next image
		$('#next').livequery("click", function(){
		
			var firstimage = $('#cur_image').val();
			$('#cur_image').val(1);
			$('img#'+firstimage).hide();
			if(firstimage <= $('#total_images').val())
			{
				firstimage = parseInt(firstimage)+parseInt(1);
				$('#cur_image').val(firstimage);
				$('img#'+firstimage).show();
			}
		});	
		// prev image
		$('#prev').livequery("click", function(){
		
			var firstimage = $('#cur_image').val();
			
			$('img#'+firstimage).hide();
			if(firstimage>0)
			{
				firstimage = parseInt(firstimage)-parseInt(1);
				$('#cur_image').val(firstimage);
				$('img#'+firstimage).show();
			}
			
		});	
		
		function UseData(){
		   $.Watermark.HideAll();
		   $.Watermark.ShowAll();
		}

	});	
	
	function isValidURL(url){
		var RegExp = /^\www([\.\-\w]+)?\.([a-z]{2,4}|travel)(:\d{2,5})?(\/.*)?$/i;
		if(RegExp.test(url)){
			return true;
		}else{
			return false;
		}
	}

	// ]]>
</script>
<body>
<input type="hidden" name="cur_image" id="cur_image" />
	<div class="box" align="left">
		<br clear="all" /><br clear="all" />
		<textarea name="url" size="64" id="url" style="width:475px; height:150px;" ></textarea>
		<div id="loader">
			<div align="center" id="load" style="display:none;"><img src="load.gif" /></div>
		</div>
		<br clear="all" />
	</div>
</body>
</html>
