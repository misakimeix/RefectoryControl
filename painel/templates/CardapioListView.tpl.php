<?php
	$this->assign('title','REFECONTROL | Cardapios');
	$this->assign('nav','cardapios');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/cardapios.js").wait(function(){
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
	<i class="icon-th-list"></i> Cardapios
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

<p id="newButtonContainer" class="buttonContainer">
		<button id="newCardapioButton" class="btn btn-primary">Add Cardapio</button>
</p>
	<!-- underscore template for the collection -->
	<script type="text/template" id="cardapioCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idcardapio">Idcardapio<% if (page.orderBy == 'Idcardapio') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Principal">Principal<% if (page.orderBy == 'Principal') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Acompanhamento">Acompanhamento<% if (page.orderBy == 'Acompanhamento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Sobremesa">Sobremesa<% if (page.orderBy == 'Sobremesa') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Suco">Suco<% if (page.orderBy == 'Suco') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idcardapio')) %>">
				<td><%= _.escape(item.get('idcardapio') || '') %></td>
				<td><%= _.escape(item.get('principal') || '') %></td>
				<td><%= _.escape(item.get('acompanhamento') || '') %></td>
				<td><%= _.escape(item.get('sobremesa') || '') %></td>
				<td><%= _.escape(item.get('suco') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="cardapioModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idcardapioInputContainer" class="control-group">
					<label class="control-label" for="idcardapio">Idcardapio</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idcardapio"><%= _.escape(item.get('idcardapio') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="principalInputContainer" class="control-group">
					<label class="control-label" for="principal">Principal</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="principal" placeholder="Principal" value="<%= _.escape(item.get('principal') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="acompanhamentoInputContainer" class="control-group">
					<label class="control-label" for="acompanhamento">Acompanhamento</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="acompanhamento" placeholder="Acompanhamento" value="<%= _.escape(item.get('acompanhamento') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="sobremesaInputContainer" class="control-group">
					<label class="control-label" for="sobremesa">Sobremesa</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="sobremesa" placeholder="Sobremesa" value="<%= _.escape(item.get('sobremesa') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="sucoInputContainer" class="control-group">
					<label class="control-label" for="suco">Suco</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="suco" placeholder="Suco" value="<%= _.escape(item.get('suco') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteCardapioButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteCardapioButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Cardapio</button>
						<span id="confirmDeleteCardapioContainer" class="hide">
							<button id="cancelDeleteCardapioButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteCardapioButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="cardapioDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Cardapio
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="cardapioModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveCardapioButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="cardapioCollectionContainer" class="collectionContainer">
	</div>


</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
