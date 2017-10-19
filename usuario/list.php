<?php 

try {
    $conn = new PDO('mysql:host=cursophp.crdgds04q7jg.us-east-1.rds.amazonaws.com;dbname=cursophp', 'root', 'cursophp');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

$data = $conn->query('SELECT * FROM usuario');

if (isset($_GET['insert'])) {
	$nome    = $_POST['nome'];
	$email 	 = $_POST['email'];
	$senha   = $_POST['senha'];

	$stm = $conn->prepare("INSERT INTO usuario(nome, email, senha) VALUES(:nome, :email, :senha)");
	$stm->bindParam(':nome', $nome);
	$stm->bindParam(':email', $email);
	$stm->bindParam(':senha', $senha);

	$stm->execute();

	header("Location:list.php");		
}

if (isset($_GET['edit'])) {
	$id 	 = $_GET['edit'];
	$nome    = $_POST['nome'];
	$email 	 = $_POST['email'];
	$senha = $_POST['senha'];

	$stmt = $conn->prepare("UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':senha', $senha);
	$stmt->bindParam(':id', $id);
	$stmt->execute();	

	header("Location:list.php");
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$stmt = $conn->prepare("DELETE FROM usuario WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	header("Location:list.php");
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Litagem Usuário</title>

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
	    <th>E-mail</th>
	    <th>Senha</th>
	    <th colspan="2">Ações</th>
	  </tr>
	  	<?php foreach($data as $value): ?>

	  <tr>
		    <td><?php echo $value['nome']; ?></td>
		    <td><?php echo $value['email']; ?></td>
		    <td><?php echo $value['senha']; ?></td>
		    <td><a href="<?php echo 'edit.php?edit='.$value['id']; ?>">Editar</a></td>
		    <td><a href="<?php echo 'list.php?delete='.$value['id']; ?>">Excluir</a></td>
	  </tr>
		<?php endforeach; ?>

	</table>
</body>
</html>