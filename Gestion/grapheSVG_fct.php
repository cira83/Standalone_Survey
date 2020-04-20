<?php
	
	function moyenne($notes){
		if(count($notes)>1) {
			$sigma = 0;
			for($i=0;$i<count($notes);$i++) $sigma += floatval($notes[$i]) ;	
			$moyenne = $sigma/$i;		
		}
		else $moyenne = -1;
		
		return $moyenne;
	}	
	
	function distribution_note($notes) {
		for($i=0;$i<10;$i++) $value[$i] = 0;
		if(is_array($notes)) {
			foreach($notes as $valeur) {
				$entier = explode(".", $valeur);
				if($entier[0]<20) $value[intdiv(intval($entier[0]),2)]++;
				else if($entier[0]<30) $value[9]++;
			}
		}
		return($value);
	}
	
	function create_graphe_svg($id,$value,$moyenne) {
		$max = 1;//Pour ne pas diviser par 0
		if(is_array($value)){
			for($i=0;$i<10;$i++)
				if($value[$i]>$max) $max = $value[$i];
		}
		$stepy = 34/$max;
		
		$image_svg = "<svg id=\"$id\" width=\"400\" height=\"50\">\n";
		$image_svg .= "<!-- max=$max -->\n";
		$image_svg .= "<rect width=\"400\" height=\"50\" style=\"fill:rgb(0,0,0);stroke-width:2;stroke:rgb(0,0,0)\" />\n";
		$image_svg .= "<rect width=\"400\" height=\"35\" style=\"fill:#fdfdfd;stroke-width:2;stroke:rgb(0,0,0)\" />\n";
		
		for($i=1;$i<$max;$i++) {
			$dy = $i*$stepy;
			$y0 = intval(35-$dy);
			$image_svg .= "<line x1=\"1\" y1=\"$y0\" x2=\"399\" y2=\"$y0\" style=\"stroke:#333;stroke-width:1\"/>\n";
		}
		if(is_array($value)){
			for($i=0;$i<10;$i++) {
				$x = $i*40 + 4;
				$tx = 2*$i;
				$ptx = $x - 6;
				if($i>4) $ptx = $ptx - 4;
				$dy = $value[$i]*$stepy;
				$y0 = 35-$dy ;
				$image_svg .= "<!-- $i = $value[$i] -->\n";
				$image_svg .= "<rect x=\"$x\" y=\"$y0\" id=\"BN$i\" width=\"34\" height=\"$dy\" style=\"fill:#ffff00;stroke-width:1;stroke:rgb(0,0,0)\" />\n";
				if($i>0) $image_svg .= "<text x=\"$ptx\" y=\"47\" fill=\"white\" font-family=\"Times\" font-size=\"12\">$tx</text>\n";
			}
		}
		$x = 2+ floatval($moyenne)*20-1; 
		if($x>397) $x=397;
		$image_svg .= "<line id=\"note\" x1=\"###\" y1=\"1\" x2=\"###\" y2=\"36\" style=\"stroke:#0f9d58;stroke-width:3\"/>\n";
		if($moyenne>-1) $image_svg .= "<line id=\"moyenne\" x1=\"$x\" y1=\"1\" x2=\"$x\" y2=\"36\" style=\"stroke:rgb(255,0,0);stroke-width:3\"/>\n";
		
		$image_svg .= "</svg>";
		return $image_svg;
	}
?>