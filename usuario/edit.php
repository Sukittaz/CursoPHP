<?php
try {
    $conn = new PDO('mysql:host=cursophp.crdgds04q7jg.us-east-1.rds.amazonaws.com;dbname=cursophp', 'root', 'cursophp');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	
	$stmt = $conn->prepare("SELECT * FROM usuario WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	$data = $stmt->fetch();
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Editar Usuário</title>
</head>
<body>	
</head>
<body>
	<form action="<?php echo 'list.php?edit='.$data['id']; ?>" method="POST">
		<label>Nome: </label><br/>
		<input type="text" name="nome" value="<?php echo $data['nome']; ?>"/><br/>
		<label>Email: </label><br/>
		<input type="email" name="email" value="<?php echo $data['email']; ?>"/><br/>
		<label>Senha: </label><br/>
		<input type="password" name="senha" value="<?php echo $data['senha']; ?>"/><br/>		
		<input type="submit" name="Enviar">			
	</form>
</body>
</html>