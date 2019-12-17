<?php
	$this->assign('title','REFECONTROL | Turmas');
	$this->assign('nav','turmas');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/turmas.js").wait(function(){
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
	<i class="icon-th-list"></i> Turmas
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="turmaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idturma">Idturma<% if (page.orderBy == 'Idturma') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nometurma">Nometurma<% if (page.orderBy == 'Nometurma') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Turno">Turno<% if (page.orderBy == 'Turno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idturma')) %>">
				<td><%= _.escape(item.get('idturma') || '') %></td>
				<td><%= _.escape(item.get('nometurma') || '') %></td>
				<td><%= _.escape(item.get('turno') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="turmaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idturmaInputContainer" class="control-group">
					<label class="control-label" for="idturma">Idturma</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idturma"><%= _.escape(item.get('idturma') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nometurmaInputContainer" class="control-group">
					<label class="control-label" for="nometurma">Nometurma</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nometurma" placeholder="Nometurma" value="<%= _.escape(item.get('nometurma') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="turnoInputContainer" class="control-group">
					<label class="control-label" for="turno">Turno</label>
					<div class="controls inline-inputs">
						<select id="turno" name="turno"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteTurmaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteTurmaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Turma</button>
						<span id="confirmDeleteTurmaContainer" class="hide">
							<button id="cancelDeleteTurmaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteTurmaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="turmaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Turma
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="turmaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveTurmaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="turmaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newTurmaButton" class="btn btn-primary">Add Turma</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
