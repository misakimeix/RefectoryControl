<?php
	$this->assign('title','REFECONTROL | Administradors');
	$this->assign('nav','administradors');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/administradors.js").wait(function(){
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
	<i class="icon-th-list"></i> Administradors
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="administradorCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idroot">Idroot<% if (page.orderBy == 'Idroot') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nome">Nome<% if (page.orderBy == 'Nome') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Senha">Senha<% if (page.orderBy == 'Senha') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idroot')) %>">
				<td><%= _.escape(item.get('idroot') || '') %></td>
				<td><%= _.escape(item.get('nome') || '') %></td>
				<td><%= _.escape(item.get('senha') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="administradorModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idrootInputContainer" class="control-group">
					<label class="control-label" for="idroot">Idroot</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idroot"><%= _.escape(item.get('idroot') || '') %></span>
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
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteAdministradorButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteAdministradorButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Administrador</button>
						<span id="confirmDeleteAdministradorContainer" class="hide">
							<button id="cancelDeleteAdministradorButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteAdministradorButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="administradorDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Administrador
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="administradorModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveAdministradorButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="administradorCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newAdministradorButton" class="btn btn-primary">Add Administrador</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
