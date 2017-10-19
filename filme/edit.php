<?php
try {
    $conn = new PDO('mysql:host=cursophp.crdgds04q7jg.us-east-1.rds.amazonaws.com;dbname=cursophp', 'root', 'cursophp');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	
	$stmt = $conn->prepare("SELECT * FROM filme WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	$data = $stmt->fetch();
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Litagem Filme</title>
</head>
<body>	
</head>
<body>
	<form action="<?php echo 'list.php?edit='.$data['id']; ?>" method="POST">
		<label>Nome: </label><br/>
		<input type="text" name="nome" value="<?php echo $data['nome']; ?>"/><br/>
		<label>Tipo: </label><br/>
		<select name="tipo">
			<option>Selecione</option>
			<option value="Terror">Terror</option>
			<option value="Ação">Ação</option>
			<option value="Animação">Animação</option>
		</select><br/>
		<label>Ano: </label><br/>
		<input type="text" name="ano" value="<?php echo $data['ano']; ?>"/><br/>		
		<label>Diretor: </label><br/>
		<input type="text" name="diretor" value="<?php echo $data['diretor']; ?>"/><br/><br/>
		<input type="submit" name="Enviar">			
	</form>
</body>
</html>