<?php
	include('conexao.php');
	include('validar.php');
?>
<!DOCTYPE html>
<html lang="pt=br">
	<head>
		<title>Lib+ Soluções</title>
	</head>
	<body>
		<?php include('menu.php'); ?>
		<a href="cadastrar_clientes.php">Cadastrar</a>
		<a href="json_listar_clientes.php">Exportar</a>
		<a href="json_importar_clientes.php">Importar</a><br><br>
		<?php
			$erro = @$_GET['erro'];
			$msg = @$_GET['msg'];
			$ok = @$_GET['ok'];
			?>
		<?php  if($erro) { ?>
			<span class="erro">
				<?php
					if ($erro == 1) {
						echo 'Não foi possível cadastrar o Cliente! Erro no banco: ' . $msg;
					} else if($erro == 2) {
						echo 'Não foi possível alterar o Cliente! Erro no banco: ' . $msg;
					} else if ($erro == 3) {
						echo 'Não foi possível excluir o Cliente! Erro no banco: ' . $msg;
					}
				?>
			</span><br><br>
		<?php  } ?>

		<?php  if($ok) { ?>
			<span class="ok">
				<?php
					if ($ok == 1) {
						echo 'Cliente cadastrado com sucesso! Código ' . $msg;
					} else if($ok == 2) {
						echo 'Cliente alterado com sucesso! Código ' . $msg;
					} else if($ok == 3) {
						echo 'Cliente excluído com sucesso! Código ' . $msg;
					}
				?>
			</span><br><br>
		<?php  } ?>
		

		<table class="tabela">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>CPF</th>
					<th>Status</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = 'SELECT id, nome, cpf, status FROM cliente';
				$query = mysqli_query($conexao, $sql);
				if (!$query) {
					echo 'Erro no banco: ' . mysqli_error($conexao);
				}
				while ($item = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			?>
				<tr>
					<td><?php echo $item['id']; ?></td>
					<td><?php echo $item['nome']; ?></td>
					<td><?php echo $item['cpf']; ?></td>
					<td><?php echo $item['status'] == 'A' ? 'Ativo' : 'Inativo'; ?></td>
					<td>
						<a href="alterar_clientes.php?id=<?php echo $item['id']; ?>">Alterar</a><br>
						<a href="excluir_clientes.php?id=<?php echo $item['id']; ?>">Excluir</a>
					</td>
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
		<p> Existe(m) <?php echo mysqli_num_rows($query); ?> registro(s)</p>
	</body>
</html>
<?php
	mysqli_close($conexao);
?>


