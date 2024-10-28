<?php
    function lang($msg) {

	    $lang = [
        	"colorsettings" => "Color Settings",
			"navbarcolor" => "Navbar color",
			"sidebarcolor" => "Sidebar color",
			"background" => "Background",
			"navbartextcolor" => "Navbar text color",
			"sidebartextcolor" => "Sidebar text color",
			"backgroundtextcolor" => "Background text color",
			"module" => "Module",
			"applicationI" => "Application I",
			"applicationII" => "Application II",
			"color" => "Color",
			"image" => "Image",	
			"apply" => "Apply",
			"cancel" => "Cancel",
			"chooseyourcolor" => "Choose your color",
			"okay" => "Okay",
			"no" => "No",

			"question1" => "Do you want to apply the selected color scheme ?", 

			'success' => 'The color has been settings successfully.',
			'fail' => 'Unsuccessful. Please try again.',
	    ];
	    
        return $lang[$msg];    
    }

?>