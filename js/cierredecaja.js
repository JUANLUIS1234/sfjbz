$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			var b= $("#b").val();
			var j= $("#j").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_cierre_de_ventas.php?action=ajax&page='+page+'&q='+q+'&j='+j+'&b='+b,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}