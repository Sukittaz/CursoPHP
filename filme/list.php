<?php 

try {
    $conn = new PDO('mysql:host=cursophp.crdgds04q7jg.us-east-1.rds.amazonaws.com;dbname=cursophp', 'root', 'cursophp');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


$data = $conn->query('SELECT * FROM filme');

if (isset($_GET['insert'])) {
	$nome    = $_POST['nome'];
	$tipo 	 = $_POST['tipo'];
	$ano 	 = $_POST['ano'];
	$diretor = $_POST['diretor'];

	$stm = $conn->prepare("INSERT INTO filme(nome, tipo, ano, diretor) VALUES(:nome, :tipo, :ano, :diretor)");
	$stm->bindParam(':nome', $nome);
	$stm->bindParam(':tipo', $tipo);
	$stm->bindParam(':ano', $ano);
	$stm->bindParam(':diretor', $diretor);

	$stm->execute();

	header("Location:list.php");		
}

if (isset($_GET['edit'])) {
	$id 	 = $_GET['edit'];
	$nome    = $_POST['nome'];
	$tipo 	 = $_POST['tipo'];
	$ano 	 = $_POST['ano'];
	$diretor = $_POST['diretor'];

	$stmt = $conn->prepare("UPDATE filme SET nome = :nome, tipo = :tipo, ano = :ano, diretor = :diretor WHERE id = :id");
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':tipo', $tipo);
	$stmt->bindParam(':ano', $ano);
	$stmt->bindParam(':diretor', $diretor);
	$stmt->bindParam(':id', $id);
	$stmt->execute();	

	header("Location:list.php");
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$stmt = $conn->prepare("DELETE FROM filme WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	header("Location:list.php");
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Litagem Filme</title>

	<style>
		table, th, td {
		    border: 1px solid black;
		}
	</style>
</head>
<body>	
</head>
<body>
	<a href="insert.html">Inserir</a>
	<table>
	  <tr>
	    <th>Nome</th>
	    <th>Tipo</th>
	    <th>Ano</th>
	    <th>Diretor</th>
	    <th colspan="2">Ações</th>
	  </tr>
	  	<?php foreach($data as $value): ?>

	  <tr>
		    <td><?php echo $value['nome']; ?></td>
		    <td><?php echo $value['tipo']; ?></td>
		    <td><?php echo $value['ano']; ?></td>
		    <td><?php echo $value['diretor']; ?></td>
		    <td><a href="<?php echo 'edit.php?edit='.$value['id']; ?>">Editar</a></td>
		    <td><a href="<?php echo 'list.php?delete='.$value['id']; ?>">Excluir</a></td>
	  </tr>
		<?php endforeach; ?>

	</table>
</body>
</html>