<?php
try {
    $conn = new PDO('mysql:host=cursophp.crdgds04q7jg.us-east-1.rds.amazonaws.com;dbname=cursophp', 'root', 'cursophp');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	
	$stmt = $conn->prepare("SELECT * FROM animal WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	$data = $stmt->fetch();
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Editar Animal</title>
</head>
<body>	
</head>
<body>
	<form action="<?php echo 'list.php?edit='.$data['id']; ?>" method="POST">
		<label>Nome: </label><br/>
		<input type="text" name="nome" value="<?php echo $data['nome']; ?>"/><br/>
		<label>Idade: </label><br/>
		<input type="text" name="idade" value="<?php echo $data['idade']; ?>"/><br/>
		<label>Espécie: </label><br/>
		<input type="text" name="especie" value="<?php echo $data['especie']; ?>"/><br/>		
		<label>Pais: </label><br/>
		<input type="text" name="pais" value="<?php echo $data['pais']; ?>"/><br/><br/>
		<input type="submit" name="Enviar">			
	</form>
</body>
</html>