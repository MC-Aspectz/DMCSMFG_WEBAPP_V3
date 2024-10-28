<?php

	function lang($msg) {
		$lang = [
        "close" => "Close",
        "search" => "Search",
        "categorycode" => "Category Code",
        "categoryname" => "Category Name",
        "describtion" => "Description",
		"accinfcde" => "Acc.Interafce Code",
		"accinf" => "Acc.Interface",
		"accinfnm" => "Acc.Interface Name",
		"insert" => "Insert",
		"update" => "Update",
		"delete" => "Delete",
		"entry" => "Entry",
		"clear" => "Clear",
		"end" => "End",
		"rowcount" => "Rowcount",
		"yes" => "Yes",
		"nono" => "No",
		"question1" => "Do you want to end this process ?",
    	"validation1" => "All the mandatory fields surrounded in red line need to be completed.",

	];

	return $lang[$msg];

}
?>