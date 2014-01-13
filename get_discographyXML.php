<?php


	function printLink($link){
		if(count($link)>0){	
			echo "sample=\"".htmlspecialchars($link[0][1])."\"";
		}
		else{
			echo "sample=\"N/A\"";
		}
	}


	function printTitleAuthor($title){
		preg_match_all("/\&quot\;(.*?)\&quot/",$title[0][1],$trueTitle,PREG_SET_ORDER);
		if(count($trueTitle)==0){
			echo "title='N/A'";
		}
		else{
			echo "title=\"".htmlspecialchars($trueTitle[0][1])."\"";
		}
		echo " ";
		preg_match_all("/\<span class=\"performer\"\>(.*?)\<\/span\>/",$title[0][1],$performers,PREG_SET_ORDER);
		if(count($performers)==0){
			echo "performer='N/A'";
		}
		else{
			preg_match_all("/\<a.*?\>(.*?)\<\/a\>/",$performers[0][1],$performer,PREG_SET_ORDER);
			if(count($performer)==0){
				echo "performer='N/A'";
			}
			else{
				echo "performer=\"".htmlspecialchars($performer[0][1]);
				for($j=1;$j<count($performer);$j++){
					echo "/".htmlspecialchars($performer[$j][1]);
				}
				echo "\"";
			}
		}
	}


	function printSongDetail($linker){
		echo " ";
//		echo "<p>";
	//	echo $linker[0][1];
		//echo "<\p>";
		if(count($linker)==0){
			echo "detail='N/A'";
		}
		else{
			if(preg_match_all("/^\/.*$/",$linker[0][1])==0){
				$linkBuffer=htmlspecialchars($linker[0][1]);
			}
			else{
				$linkBuffer="http://www.allmusic.com".htmlspecialchars($linker[0][1]);
			}
			echo "detail=\"".$linkBuffer."\"";
		}
		echo " ";
	}


	function printComposers($composers){
		if(count($composers)==0){
			echo "composers='N/A'";
		}
		else{
			preg_match_all("/\<a.*?\>(.*?)\<\/a\>/",$composers[0][1],$composer,PREG_SET_ORDER);
			if(count($composer)==0){
				echo "composers='N/A'";
			}
			else{
				echo "composers=\"".htmlspecialchars($composer[0][1]);
				for($j=1;$j<count($composer);$j++){
					echo "/".htmlspecialchars($composer[$j][1]);
				}
				echo "\"";
			}
		}
		echo " ";
	}


	function printSongs($songArray){
	//	echo count($songArray);
		
		//echo "<tr><th>Sample</th><th>Title</th><th>Performer</th><th>Composer(s)</th><th>Details</th></tr>";
		foreach ($songArray as $var){
			//echo "<tr>";
			//echo "<td>";
			echo "<result ";
			preg_match_all("/\<a href=\"([\s\S]*?)\" title=\"play sample\"\>/", $var[0], $link, PREG_SET_ORDER);
			printLink($link);
			echo " ";
			preg_match_all("/\<div class=\"title\"\>([\s\S]*?)\<\/div\>/",$var[0],$title,PREG_SET_ORDER);
			printTitleAuthor($title);
			echo " ";
			preg_match_all("/\<div class=\"info\"\>([\s\S]*?)\<\/div\>/",$var[0],$composers,PREG_SET_ORDER);
			printComposers($composers);
			preg_match_all("/\<a title=[\s\S]*?href=\"([\s\S]*?)\"/",$var[0],$linker,PREG_SET_ORDER);
			printSongDetail($linker);
			//echo $linker[0][1];
			echo "/>\n";
			
		}
//		echo "</table>";
	//	echo "</div>";
	}






	function printImage($img){
		echo " ";
		if(count($img)>0){	
			echo "cover=\"".htmlspecialchars($img[0][1])."\"";
		}
		else{
			echo "cover='N/A'";
		}
		echo " ";
	}




	function printTitle($name){
		echo " ";
		if(count($name)==0){
			echo "title='N/A'";
		}
		else{
			preg_match_all("/\<a.*?\>(.*?)\<\/a\>/",$name[0][1],$guy,PREG_SET_ORDER);
			if(count($guy)==0){
				echo "title='N/A'";
			}
			else{
				echo "title=\"".htmlspecialchars($guy[0][1]);
				for($j=1;$j<count($guy);$j++){
					echo "/".htmlspecialchars($guy[$j][1]);
				}
				echo "\"";
			}
		}
		echo " ";
	}



	function printName($name){
		echo " ";
		if(count($name)==0){
			echo "name=\"N/A\"";
		}
		else{
			preg_match_all("/\<a.*?\>(.*?)\<\/a\>/",$name[0][1],$guy,PREG_SET_ORDER);
			if(count($guy)==0){
				preg_match_all("/[\S]+/",$name[0][1],$guy1,PREG_SET_ORDER);
				if(count($guy1)==0){
					echo "name=\"N/A\"";
				}
				else{
					echo "name=\"".htmlspecialchars($guy1[0][0]);
					for($j=1;$j<count($guy1);$j++){
						echo "/".htmlspecialchars($guy1[$j][0]);
					}
					echo "\"";
				}
			}
			else{
				echo "name=\"".htmlspecialchars($guy[0][1]);
				for($j=1;$j<count($guy);$j++){
					echo "/".htmlspecialchars($guy[$j][1]);
				}
				echo "\"";
			}
		}
		echo " ";
	}





	function printGenreYear($genre){
		echo " ";
		if(count($genre)==0){
			echo "genre='N/A'";
		}
		else{
			preg_match_all("/[\s]*?(\S[\s\S]*?\S)[\s]*?\<br\/\>/",$genre[0][1],$gen,PREG_SET_ORDER);
			if(count($gen)==0){
				echo "genre='N/A'";
			}
			else{
				echo "genre=\"".htmlspecialchars($gen[0][1])."\"";
			}
		}
		echo " ";

		echo " ";
		if(count($genre)==0){
			echo "year='N/A'";
		}
		else{
			preg_match_all("/\<br\/\>\s*?(\S[\s\S]*?\S)\s*?$/",$genre[0][1],$year,PREG_SET_ORDER);
			if(count($year)==0){
				echo "year='N/A'";
			}
			else{
				echo "year=\"".htmlspecialchars($year[0][1])."\"";
			}
		}
		echo " ";
	}







	function printArtDetail($detail){
		echo " ";
		if(count($detail)==0){
			echo "details='N/A'";
		}
		else{
			preg_match_all("/\<a href=\"([\s\S]*?)\"/",$detail[0][1],$link,PREG_SET_ORDER);
			if(count($link)==0){
				echo "details='N/A'";
			}
			else{
				if(preg_match_all("/^\/.*$/",$link[0][1])==0){
					$linkBuffer=htmlspecialchars($link[0][1]);
				}
				else{
					$linkBuffer="http://www.allmusic.com".htmlspecialchars($link[0][1]);
				}
				echo "details=\"".$linkBuffer."\"";
			}
		}
		echo " ";
	}




		function printArts($artArray){
	//	echo count($artArray);
		//echo "<div>";
		//echo "<table border=1px width='100%'>";
		//echo "<tr><th>Image</th><th>Name</th><th>Genre(s)</th><th>Year(s)</th><th>Details</th></tr>";
		foreach ($artArray as $var){
			echo "<result ";
			preg_match_all("/\<img src=\"([\s\S]*?)\"/", $var[0], $img, PREG_SET_ORDER);
			printImage($img);
			preg_match_all("/\<div class=\"name\"\>([\s\S]*?)\<\/div\>/",$var[0],$name,PREG_SET_ORDER);
			printName($name);
			preg_match_all("/\<div class=\"info\"\>([\s\S]*?)\<\/div\>/",$var[0],$genre,PREG_SET_ORDER);
			printGenreYear($genre);
			preg_match_all("/\<div class=\"name\"\>([\s\S]*?)\<\/div\>/",$var[0],$detail,PREG_SET_ORDER);
			printArtDetail($detail);
			echo " />\n";
			
		}
//		echo "</table>";
	//	echo "</div>";
	}









	function printGenreYearA($genre){
		
		echo " ";
		if(count($genre)==0){
			echo "year='N/A'";
		}
		else{
			preg_match_all("/\<br\/\>\s*?(\S[\s\S]*?\S)\s*?$/",$genre[0][1],$year,PREG_SET_ORDER);
			if(count($year)==0){
				echo "year='N/A'";
			}
			else{
				echo "year=\"".htmlspecialchars($year[0][1])."\"";
			}
		}
		echo " ";
	
		echo " ";
		if(count($genre)==0){
			echo "genre='N/A'";
		}
		else{
			preg_match_all("/[\s]*?(\S[\s\S]*?\S)[\s]*?\<br\/\>/",$genre[0][1],$gen,PREG_SET_ORDER);
			if(count($gen)==0){
				echo "genre='N/A'";
			}
			else{
				echo "genre=\"".htmlspecialchars($gen[0][1])."\"";
			}
		}
		echo " ";

	}




	function printAlbum($albumArray){
	//	echo count($artArray);
//		echo "<div>";
	//	echo "<table border=1px width='100%'>";
		//echo "<tr><th>Image</th><th>Title</th><th>Artist</th><th>Genre(s)</th><th>Year</th><th>Details</th></tr>";
		foreach ($albumArray as $var){
			echo "<result ";
			preg_match_all("/\<img src=\"([\s\S]*?)\"/", $var[0], $img, PREG_SET_ORDER);
			printImage($img);
			preg_match_all("/\<div class=\"title\"\>([\s\S]*?)\<\/div\>/",$var[0],$name,PREG_SET_ORDER);
			printTitle($name);
			preg_match_all("/\<div class=\"artist\"\>([\s\S]*?)\<\/div\>/",$var[0],$art,PREG_SET_ORDER);
			printName($art);
			preg_match_all("/\<div class=\"info\"\>([\s\S]*?)\<\/div\>/",$var[0],$genre,PREG_SET_ORDER);
			printGenreYearA($genre);
			preg_match_all("/\<div class=\"title\"\>([\s\S]*?)\<\/div\>/",$var[0],$detail,PREG_SET_ORDER);
			printArtDetail($detail);
			echo " />\n";
			
		}
//		echo "</table>";
	//	echo "</div>";
	}

	echo "<?xml version='1.0' encoding='utf-8'?>\n";
	echo "<results>\n";
	$url="http://www.allmusic.com/search/";
	$name=$_GET["inputText"];
	$type=$_GET["choosedType"];	
	$nameArray=explode(" ",$name);
	preg_match_all('/\b[^\s]+\b/', $name, $mat);
	$codeName=$mat[0][0];
	for ($i=1;$i<count($mat[0]);$i++){
		$codeName=$codeName."+".$mat[0][$i];
	}	
	$finalUrl=$url.$type."/".utf8_encode($codeName);
//	echo $finalUrl;
	$html=file_get_contents($finalUrl);
	//echo $http_response_header[0];
	//echo $html;
//	echo "<h1>Search Result</h1>";	
	//echo '<h3>"'.$name.'" of type "'.$type.'"</h3>';
	if(preg_match_all("/No results found for the term/",$html)>0){
		//echo "<h1>No discography found!</h1>";
			echo "No discography";
	}	
	else{		
		if($type=="songs"){	
			preg_match_all("/<tr class=\"search-result song\">[\s\S]*?<\/tr>/",$html,$songArray,PREG_SET_ORDER);
			printSongs($songArray);
		}	
		else if($type=="artists"){
			preg_match_all("/<tr class=\"search-result artist\">[\s\S]*?<\/tr>/",$html,$artArray,PREG_SET_ORDER);
			printArts($artArray);
		}	
		else{		
			preg_match_all("/<tr class=\"search-result album\">[\s\S]*?<\/tr>/",$html,$albumArray,PREG_SET_ORDER);
			printAlbum($albumArray);
		}

	}
	echo "</results>";
	
	
?>
