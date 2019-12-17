<?php
	$this->assign('title','REFECONTROL | Semanas');
	$this->assign('nav','semanas');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/semanas.js").wait(function(){
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
	<i class="icon-th-list"></i> Semanas
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="semanaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idsemana">Idsemana<% if (page.orderBy == 'Idsemana') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Seg">Seg<% if (page.orderBy == 'Seg') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Ter">Ter<% if (page.orderBy == 'Ter') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Qua">Qua<% if (page.orderBy == 'Qua') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Qui">Qui<% if (page.orderBy == 'Qui') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Sex">Sex<% if (page.orderBy == 'Sex') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Sab">Sab<% if (page.orderBy == 'Sab') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idsemana')) %>">
				<td><%= _.escape(item.get('idsemana') || '') %></td>
				<td><%= _.escape(item.get('seg') || '') %></td>
				<td><%= _.escape(item.get('ter') || '') %></td>
				<td><%= _.escape(item.get('qua') || '') %></td>
				<td><%= _.escape(item.get('qui') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('sex') || '') %></td>
				<td><%= _.escape(item.get('sab') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="semanaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idsemanaInputContainer" class="control-group">
					<label class="control-label" for="idsemana">Idsemana</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idsemana"><%= _.escape(item.get('idsemana') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="segInputContainer" class="control-group">
					<label class="control-label" for="seg">Seg</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="seg" placeholder="Seg" value="<%= _.escape(item.get('seg') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="terInputContainer" class="control-group">
					<label class="control-label" for="ter">Ter</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="ter" placeholder="Ter" value="<%= _.escape(item.get('ter') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="quaInputContainer" class="control-group">
					<label class="control-label" for="qua">Qua</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="qua" placeholder="Qua" value="<%= _.escape(item.get('qua') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="quiInputContainer" class="control-group">
					<label class="control-label" for="qui">Qui</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="qui" placeholder="Qui" value="<%= _.escape(item.get('qui') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="sexInputContainer" class="control-group">
					<label class="control-label" for="sex">Sex</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="sex" placeholder="Sex" value="<%= _.escape(item.get('sex') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="sabInputContainer" class="control-group">
					<label class="control-label" for="sab">Sab</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="sab" placeholder="Sab" value="<%= _.escape(item.get('sab') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteSemanaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteSemanaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Semana</button>
						<span id="confirmDeleteSemanaContainer" class="hide">
							<button id="cancelDeleteSemanaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteSemanaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="semanaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Semana
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="semanaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveSemanaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="semanaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newSemanaButton" class="btn btn-primary">Add Semana</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
