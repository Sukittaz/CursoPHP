<?php 

try {
    $conn = new PDO('mysql:host=cursophp.crdgds04q7jg.us-east-1.rds.amazonaws.com;dbname=cursophp', 'root', 'cursophp');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


$data = $conn->query('SELECT * FROM animal');

if (isset($_GET['insert'])) {
	$nome    = $_POST['nome'];
	$idade 	 = $_POST['idade'];
	$especie = $_POST['especie'];
	$pais    = $_POST['pais'];

	$stm = $conn->prepare("INSERT INTO animal(nome, idade, especie, pais) VALUES(:nome, :idade, :especie, :pais)");
	$stm->bindParam(':nome', $nome);
	$stm->bindParam(':idade', $idade);
	$stm->bindParam(':especie', $especie);
	$stm->bindParam(':pais', $pais);

	$stm->execute();

	header("Location:list.php");		
}

if (isset($_GET['edit'])) {
	$id 	 = $_GET['edit'];
	$nome    = $_POST['nome'];
	$idade 	 = $_POST['idade'];
	$especie = $_POST['especie'];
	$pais    = $_POST['pais'];	

	$stmt = $conn->prepare("UPDATE animal SET nome = :nome, idade = :idade, especie = :especie, pais = :pais WHERE id = :id");
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':idade', $idade);
	$stmt->bindParam(':especie', $especie);
	$stmt->bindParam(':pais', $pais);
	$stmt->bindParam(':id', $id);
	$stmt->execute();	

	header("Location:list.php");
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$stmt = $conn->prepare("DELETE FROM animal WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	header("Location:list.php");
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Litagem Animal</title>

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
	    <th>Idade</th>
	    <th>Especie</th>
	    <th>Pais</th>
	    <th colspan="2">Ações</th>
	  </tr>
	  	<?php foreach($data as $value): ?>
		  <tr>
			    <td><?php echo $value['nome']; ?></td>
			    <td><?php echo $value['idade']; ?></td>
			    <td><?php echo $value['especie']; ?></td>
			    <td><?php echo $value['pais']; ?></td>
			    <td><a href="<?php echo 'edit.php?edit='.$value['id']; ?>">Editar</a></td>
			    <td><a href="<?php echo 'list.php?delete='.$value['id']; ?>">Excluir</a></td>
		  </tr>
		<?php endforeach; ?>
	</table>
</body>
</html>