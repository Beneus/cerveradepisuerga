<?php

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos

		for ($i=1;$i<25;$i++){
			echo "../NucleosUrbanos/$i<br/>";
			if (!is_dir("../NucleosUrbanos/$i")){
				mkdir("../NucleosUrbanos/$i");
				chmod("../NucleosUrbanos/$i",0777);
			}
			if (!is_dir("../NucleosUrbanos/$i/images")){
				mkdir("../NucleosUrbanos/$i/images");
				chmod("../NucleosUrbanos/$i/images",0777);
			}
			if (!is_dir("../NucleosUrbanos/$i/thumb")){
				mkdir("../NucleosUrbanos/$i/thumb");
				chmod("../NucleosUrbanos/$i/thumb",0777);
			}
		}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


?>