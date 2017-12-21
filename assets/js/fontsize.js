	 $(document).ready(function() { 
		$('#incfont').click(function(){	   
        curSize= parseInt($('#content').css('font-size')) + 2;
		if(curSize<=18)
        $('#content').css('font-size', curSize);
        });  
		$('#decfont').click(function(){	   
        curSize= parseInt($('#content').css('font-size')) - 2;
		if(curSize>=12)
        $('#content').css('font-size', curSize);
        }); 
	});
