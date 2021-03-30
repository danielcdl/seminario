<?php
include '../base/base.php';
?>

<div class="container mt-5">
	<div class="row mt-5 ">
		<div class="col">	
			<div class="card mt-5">
				<!-- cabeçalho do card -->
				<div class="card-header">
					<div class="row">
						<!-- mes -->
						<div class="col-md-10">
							<div class="row">
								<div class="col-md-2">
									<a href="#"	type="button" class="btn ml-2" title="Anterior"><b><<</b></a>
								</div>
								<div class="col-md-2">
									<h4><?php echo $meses[(int)$mes]; ?></h4>
								</div>
								<div class="col-md-2">
									<a href="#"	type="button" class="btn mr-2" title="Próximo"><b>>></b></a>
								</div>
							</div>
						</div>
						<!-- mes -->
							
						<!-- ano -->
						<div class="col-md-2">
							<h3><?php echo $ano; ?></h3>
						</div>
						<!-- ano -->
					</div>				
				</div>
				<!-- cabeçalho do card -->

				<!-- corpo da card -->
				<div class="card-body">
					<!-- tabela -->
					<table id="tabela" class="table table-bordered">
						<!-- cabecalho da tabela -->
						<thead class="thead-dark">
							<tr>
								<th>Domingo</th>
								<th>Segunda</th>
								<th>Terça</th>
								<th>Quarta</th>
								<th>Quinta</th>
								<th>Sexta</th>
								<th>Sábado</th>
							</tr>
						</thead>
						<!-- cabecalho da tabela -->

						<!-- corpo da tabela -->
						<tbody>
						<?php
							foreach ($calendario as $semana) {
								echo '<tr>';	
									foreach ($semana as $dia) {
										echo '<th class="';
										if ($dia['status'] == 'disponivel') {
											echo 'table-primary">';
										} else {
											echo 'table-active">';
										}

											echo '<h2><a href="#">'.$dia['dia'].'</a></h2>';
											if ($dia['status'] == 'disponivel') {
												echo '<div class="list-group">
																<a href="#" type="button" class="list-group-item list-group-item-primary">
																	Manhã
																	<span class="badge badge-primary badge-pill">' . $dia['motivo']['manha'] .' </span>
																</a>
																<a href="#" type="button" class="list-group-item list-group-item-info">
																	Tarde
																	<span class="badge badge-primary badge-pill">' . $dia['motivo']['tarde'] . '</span>
																</a>
															</div>';
											} elseif (isset($dia['motivo'])) {
												if ($dia['motivo'] != 'mes') {
													echo $dia['motivo'];
												}
											}
										echo '</th>';
									}
								echo '</tr>';
							}
						?>
						</tbody>
					</table>
				</div>
				<!-- corpo do card -->
			</div>
		</div>
	</div>
</div>

<?php
include 'base/footer.php'
?>