<?php
	$this->assign('title','REFECONTROL | Turnos');
	$this->assign('nav','turnos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/turnos.js").wait(function(){
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
	<i class="icon-th-list"></i> Turnos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="turnoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idturno">Idturno<% if (page.orderBy == 'Idturno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Horario">Horario<% if (page.orderBy == 'Horario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Dias">Dias<% if (page.orderBy == 'Dias') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idturno')) %>">
				<td><%= _.escape(item.get('idturno') || '') %></td>
				<td><%= _.escape(item.get('horario') || '') %></td>
				<td><%= _.escape(item.get('dias') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="turnoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idturnoInputContainer" class="control-group">
					<label class="control-label" for="idturno">Idturno</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idturno"><%= _.escape(item.get('idturno') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="horarioInputContainer" class="control-group">
					<label class="control-label" for="horario">Horario</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="horario" placeholder="Horario" value="<%= _.escape(item.get('horario') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="diasInputContainer" class="control-group">
					<label class="control-label" for="dias">Dias</label>
					<div class="controls inline-inputs">
						<select id="dias" name="dias"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteTurnoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteTurnoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Turno</button>
						<span id="confirmDeleteTurnoContainer" class="hide">
							<button id="cancelDeleteTurnoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteTurnoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="turnoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Turno
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="turnoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveTurnoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="turnoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newTurnoButton" class="btn btn-primary">Add Turno</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
