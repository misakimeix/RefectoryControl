<?php
	$this->assign('title','REFECONTROL | Alunos');
	$this->assign('nav','alunos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/alunos.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Alunos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="alunoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idaluno">Idaluno<% if (page.orderBy == 'Idaluno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Matricula">Matricula<% if (page.orderBy == 'Matricula') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nome">Nome<% if (page.orderBy == 'Nome') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Senha">Senha<% if (page.orderBy == 'Senha') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Turma">Turma<% if (page.orderBy == 'Turma') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Imagem">Imagem<% if (page.orderBy == 'Imagem') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Condicao">Condicao<% if (page.orderBy == 'Condicao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idaluno')) %>">
				<td><%= _.escape(item.get('idaluno') || '') %></td>
				<td><%= _.escape(item.get('matricula') || '') %></td>
				<td><%= _.escape(item.get('nome') || '') %></td>
				<td><%= _.escape(item.get('senha') || '') %></td>
				<td><%= _.escape(item.get('turma') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('imagem') || '') %></td>
				<td><%= _.escape(item.get('condicao') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="alunoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idalunoInputContainer" class="control-group">
					<label class="control-label" for="idaluno">Idaluno</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idaluno"><%= _.escape(item.get('idaluno') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="matriculaInputContainer" class="control-group">
					<label class="control-label" for="matricula">Matricula</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="matricula" placeholder="Matricula" value="<%= _.escape(item.get('matricula') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeInputContainer" class="control-group">
					<label class="control-label" for="nome">Nome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nome" placeholder="Nome" value="<%= _.escape(item.get('nome') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="senhaInputContainer" class="control-group">
					<label class="control-label" for="senha">Senha</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="senha" placeholder="Senha" value="<%= _.escape(item.get('senha') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="turmaInputContainer" class="control-group">
					<label class="control-label" for="turma">Turma</label>
					<div class="controls inline-inputs">
						<select id="turma" name="turma"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="imagemInputContainer" class="control-group">
					<label class="control-label" for="imagem">Imagem</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="imagem" placeholder="Imagem" value="<%= _.escape(item.get('imagem') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="condicaoInputContainer" class="control-group">
					<label class="control-label" for="condicao">Condicao</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="condicao" placeholder="Condicao" value="<%= _.escape(item.get('condicao') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteAlunoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteAlunoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Aluno</button>
						<span id="confirmDeleteAlunoContainer" class="hide">
							<button id="cancelDeleteAlunoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteAlunoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="alunoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Aluno
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="alunoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveAlunoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="alunoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newAlunoButton" class="btn btn-primary">Add Aluno</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
