$(function() {
	
	//Custom checkboxes
    //------------------------
		$(".bootstrap-switch").bootstrapSwitch();
		
		// iCheck
		// Loop through all the checkbox/radio classes and assign them colors and styles
		var myArr=["minimal","flat","square"];
		var aCol=['red','green','aero','grey','orange','pink','purple','yellow','purple','yellow','blue']

		for (var i = 0; i < myArr.length; ++i) {
			for (var j = 0; j < aCol.length; ++j) {
				// $('.icheck-minimal .blue.icheck input').iCheck({checkboxClass: 'icheckbox_minimal-blue',radioClass: 'iradio_minimal-blue'});
				$('.icheck-' + myArr[i] + ' .' + aCol[j] + '.icheck input').iCheck({checkboxClass: 'icheckbox_' + myArr[i] + '-' + aCol[j],radioClass: 'iradio_' + myArr[i] + '-' + aCol[j]});
			}
		}


});
