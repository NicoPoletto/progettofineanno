<?php

if(isset($_POST['save_audio']) && $_POST['save_audio']=="Upload Audio"){
		$target_file = 'uploads/' . $_FILES['audioFile']['name'];
		
		if (file_exists($target_file)) {
  			echo 'File già caricato';
  			exit;
			}
	
	    //cartella che contiene i file inviati
		$dir='uploads/';
		
		$audio_patch=$dir.basename($_FILES['audioFile']['name']);
		
		if(move_uploaded_file($_FILES['audioFile']['tmp_name'],$audio_patch)){

			echo'Upload avvenuto con successo.!';
			saveAudio($audio_patch);
		    displayAudios();
			
			}
	
	}


function displayAudios(){	
	$conn = mysqli_connect('127.0.0.1', 'root', '', 'audio_db');
	if (!$conn) {
				die ('Non riesco a connettermi: ' . mysqli_error());
				}
				
	$query="select * from musica";
	
	$r=mysqli_query($conn,$query);
	
		while($row=mysqli_fetch_array($r)){
			echo '<a href="play.php?name='.$row['filename'].'">'.$row['filename'].'</a>';
			echo "<br/>";
			}
			
			mysqli_close($conn);
}
	
	
function saveAudio($fileName){
	$conn = mysqli_connect('127.0.0.1', 'root', '', 'audio_db');
	if (!$conn) {
				die ('Non riesco a connettermi: ' . mysqli_error());
				}
				
	$query="insert into musica(filename)values('{$fileName}')";

	mysqli_query($conn,$query);
	
	if(mysqli_affected_rows($conn)>0){
		echo ' ';
		echo"File Audio salvato nel Database !";
		}
		
		
	mysqli_close($conn);
	
	
	}

?>