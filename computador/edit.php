<?php
try {
    $conn = new PDO('mysql:host=cursophp.crdgds04q7jg.us-east-1.rds.amazonaws.com;dbname=cursophp', 'root', 'cursophp');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	
	$stmt = $conn->prepare("SELECT * FROM computador WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	$data = $stmt->fetch();
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Editar Computador</title>
</head>
<body>	
</head>
<body>
	<form action="<?php echo 'list.php?edit='.$data['id']; ?>" method="POST">
		<label>Placa Mãe: </label><br/>
		<input type="text" name="placa" value="<?php echo $data['placa']; ?>"/><br/>
		<label>Processador: </label><br/>
		<input type="text" name="processador" value="<?php echo $data['processador']; ?>"/><br/>
		<label>Sistema: </label><br/>
		<select name="sistema">
			<option>Selecione</option>
			<option value="Windows">Windows</option>
			<option value="Linux">Linux</option>
		</select><br/><br/>
		<input type="submit" name="Enviar">			
	</form>
</body>
</html>