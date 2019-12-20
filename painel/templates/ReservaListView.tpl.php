<?php
	$this->assign('title','REFECONTROL | Reservas');
	$this->assign('nav','reservas');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/reservas.js").wait(function(){
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
	<i class="icon-th-list"></i> Reservas
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

<p id="newButtonContainer" class="buttonContainer">
		<button id="newReservaButton" class="btn btn-primary">Add Reserva</button>
</p>
	<!-- underscore template for the collection -->
	<script type="text/template" id="reservaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idreserva">Idreserva<% if (page.orderBy == 'Idreserva') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DataDaReserva">Data Da Reserva<% if (page.orderBy == 'DataDaReserva') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Quantidade">Quantidade<% if (page.orderBy == 'Quantidade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Turmaturno">Turmaturno<% if (page.orderBy == 'Turmaturno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Horario">Horario<% if (page.orderBy == 'Horario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idreserva')) %>">
				<td><%= _.escape(item.get('idreserva') || '') %></td>
				<td><%if (item.get('dataDaReserva')) { %><%= _date(app.parseDate(item.get('dataDaReserva'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('quantidade') || '') %></td>
				<td><%= _.escape(item.get('turmaturno') || '') %></td>
				<td><%= _.escape(item.get('horario') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="reservaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idreservaInputContainer" class="control-group">
					<label class="control-label" for="idreserva">Idreserva</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idreserva"><%= _.escape(item.get('idreserva') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataDaReservaInputContainer" class="control-group">
					<label class="control-label" for="dataDaReserva">Data Da Reserva</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dataDaReserva" type="text" value="<%= _date(app.parseDate(item.get('dataDaReserva'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="quantidadeInputContainer" class="control-group">
					<label class="control-label" for="quantidade">Quantidade</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="quantidade" placeholder="Quantidade" value="<%= _.escape(item.get('quantidade') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="turmaturnoInputContainer" class="control-group">
					<label class="control-label" for="turmaturno">Turmaturno</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="turmaturno" placeholder="Turmaturno" value="<%= _.escape(item.get('turmaturno') || '') %>">
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
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteReservaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteReservaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Reserva</button>
						<span id="confirmDeleteReservaContainer" class="hide">
							<button id="cancelDeleteReservaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteReservaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="reservaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Reserva
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="reservaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveReservaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="reservaCollectionContainer" class="collectionContainer">
	</div>


</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
