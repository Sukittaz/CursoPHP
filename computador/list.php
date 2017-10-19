<?php 

try {
    $conn = new PDO('mysql:host=cursophp.crdgds04q7jg.us-east-1.rds.amazonaws.com;dbname=cursophp', 'root', 'cursophp');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


$data = $conn->query('SELECT * FROM computador');

if (isset($_GET['insert'])) {
	$placa    		 = $_POST['placa'];
	$processador 	 = $_POST['processador'];
	$sistema   		 = $_POST['sistema'];

	$stm = $conn->prepare("INSERT INTO computador(placa, processador, sistema) VALUES(:placa, :processador, :sistema)");
	$stm->bindParam(':placa', $placa);
	$stm->bindParam(':processador', $processador);
	$stm->bindParam(':sistema', $sistema);

	$stm->execute();

	header("Location:list.php");		
}

if (isset($_GET['edit'])) {
	$id 	 		 = $_GET['edit'];
	$placa    		 = $_POST['placa'];
	$processador 	 = $_POST['processador'];
	$sistema   		 = $_POST['sistema'];

	$stmt = $conn->prepare("UPDATE computador SET placa = :placa, processador = :processador, sistema = :sistema WHERE id = :id");
	$stmt->bindParam(':placa', $placa);
	$stmt->bindParam(':processador', $processador);
	$stmt->bindParam(':sistema', $sistema);
	$stmt->bindParam(':id', $id);
	$stmt->execute();	

	header("Location:list.php");
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$stmt = $conn->prepare("DELETE FROM computador WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	header("Location:list.php");
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Litagem Computador</title>

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
	    <th>Placa Mãe</th>
	    <th>Processador</th>
	    <th>Sistema Operacional</th>
	    <th colspan="2">Ações</th>
	  </tr>
	  	<?php foreach($data as $value): ?>

	  <tr>
		    <td><?php echo $value['placa']; ?></td>
		    <td><?php echo $value['processador']; ?></td>
		    <td><?php echo $value['sistema']; ?></td>
		    <td><a href="<?php echo 'edit.php?edit='.$value['id']; ?>">Editar</a></td>
		    <td><a href="<?php echo 'list.php?delete='.$value['id']; ?>">Excluir</a></td>
	  </tr>
		<?php endforeach; ?>

	</table>
</body>
</html>