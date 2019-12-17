/**
 * backbone model definitions for REFECONTROL
 */

/**
 * Use emulated HTTP if the server doesn't support PUT/DELETE or application/json requests
 */
Backbone.emulateHTTP = false;
Backbone.emulateJSON = false;

var model = {};

/**
 * long polling duration in miliseconds.  (5000 = recommended, 0 = disabled)
 * warning: setting this to a low number will increase server load
 */
model.longPollDuration = 0;

/**
 * whether to refresh the collection immediately after a model is updated
 */
model.reloadCollectionOnModelUpdate = true;


/**
 * a default sort method for sorting collection items.  this will sort the collection
 * based on the orderBy and orderDesc property that was used on the last fetch call
 * to the server. 
 */
model.AbstractCollection = Backbone.Collection.extend({
	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	lastRequestParams: null,
	collectionHasChanged: true,
	
	/**
	 * fetch the collection from the server using the same options and 
	 * parameters as the previous fetch
	 */
	refetch: function() {
		this.fetch({ data: this.lastRequestParams })
	},
	
	/* uncomment to debug fetch event triggers
	fetch: function(options) {
            this.constructor.__super__.fetch.apply(this, arguments);
	},
	// */
	
	/**
	 * client-side sorting baesd on the orderBy and orderDesc parameters that
	 * were used to fetch the data from the server.  Backbone ignores the
	 * order of records coming from the server so we have to sort them ourselves
	 */
	comparator: function(a,b) {
		
		var result = 0;
		var options = this.lastRequestParams;
		
		if (options && options.orderBy) {
			
			// lcase the first letter of the property name
			var propName = options.orderBy.charAt(0).toLowerCase() + options.orderBy.slice(1);
			var aVal = a.get(propName);
			var bVal = b.get(propName);
			
			if (isNaN(aVal) || isNaN(bVal)) {
				// treat comparison as case-insensitive strings
				aVal = aVal ? aVal.toLowerCase() : '';
				bVal = bVal ? bVal.toLowerCase() : '';
			} else {
				// treat comparision as a number
				aVal = Number(aVal);
				bVal = Number(bVal);
			}
			
			if (aVal < bVal) {
				result = options.orderDesc ? 1 : -1;
			} else if (aVal > bVal) {
				result = options.orderDesc ? -1 : 1;
			}
		}
		
		return result;

	},
	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, options) {

		// the response is already decoded into object form, but it's easier to
		// compary the stringified version.  some earlier versions of backbone did
		// not include the raw response so there is some legacy support here
		var responseText = options && options.xhr ? options.xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastRequestParams = options ? options.data : undefined;
		
		// if the collection has changed then we need to force a re-sort because backbone will
		// only resort the data if a property in the model has changed
		if (this.lastResponseText && this.collectionHasChanged) this.sort({ silent:true });
		
		this.lastResponseText = responseText;
		
		var rows;

		if (response.currentPage) {
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		} else {
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Administrador Backbone Model
 */
model.AdministradorModel = Backbone.Model.extend({
	urlRoot: 'api/administrador',
	idAttribute: 'idroot',
	idroot: '',
	nome: '',
	senha: '',
	defaults: {
		'idroot': null,
		'nome': '',
		'senha': ''
	}
});

/**
 * Administrador Backbone Collection
 */
model.AdministradorCollection = model.AbstractCollection.extend({
	url: 'api/administradors',
	model: model.AdministradorModel
});

/**
 * Aluno Backbone Model
 */
model.AlunoModel = Backbone.Model.extend({
	urlRoot: 'api/aluno',
	idAttribute: 'idaluno',
	idaluno: '',
	matricula: '',
	nome: '',
	senha: '',
	turma: '',
	imagem: '',
	condicao: '',
	defaults: {
		'idaluno': null,
		'matricula': '',
		'nome': '',
		'senha': '',
		'turma': '',
		'imagem': '',
		'condicao': ''
	}
});

/**
 * Aluno Backbone Collection
 */
model.AlunoCollection = model.AbstractCollection.extend({
	url: 'api/alunos',
	model: model.AlunoModel
});

/**
 * Cardapio Backbone Model
 */
model.CardapioModel = Backbone.Model.extend({
	urlRoot: 'api/cardapio',
	idAttribute: 'idcardapio',
	idcardapio: '',
	principal: '',
	acompanhamento: '',
	sobremesa: '',
	suco: '',
	defaults: {
		'idcardapio': null,
		'principal': '',
		'acompanhamento': '',
		'sobremesa': '',
		'suco': ''
	}
});

/**
 * Cardapio Backbone Collection
 */
model.CardapioCollection = model.AbstractCollection.extend({
	url: 'api/cardapios',
	model: model.CardapioModel
});

/**
 * Ficha Backbone Model
 */
model.FichaModel = Backbone.Model.extend({
	urlRoot: 'api/ficha',
	idAttribute: 'idficha',
	idficha: '',
	dataDasFichas: '',
	fichasMinimasDoDia: '',
	cardapio: '',
	defaults: {
		'idficha': null,
		'dataDasFichas': new Date(),
		'fichasMinimasDoDia': '',
		'cardapio': ''
	}
});

/**
 * Ficha Backbone Collection
 */
model.FichaCollection = model.AbstractCollection.extend({
	url: 'api/fichas',
	model: model.FichaModel
});

/**
 * Reserva Backbone Model
 */
model.ReservaModel = Backbone.Model.extend({
	urlRoot: 'api/reserva',
	idAttribute: 'idreserva',
	idreserva: '',
	dataDaReserva: '',
	quantidade: '',
	turmaturno: '',
	horario: '',
	defaults: {
		'idreserva': null,
		'dataDaReserva': new Date(),
		'quantidade': '',
		'turmaturno': '',
		'horario': ''
	}
});

/**
 * Reserva Backbone Collection
 */
model.ReservaCollection = model.AbstractCollection.extend({
	url: 'api/reservas',
	model: model.ReservaModel
});

/**
 * Semana Backbone Model
 */
model.SemanaModel = Backbone.Model.extend({
	urlRoot: 'api/semana',
	idAttribute: 'idsemana',
	idsemana: '',
	seg: '',
	ter: '',
	qua: '',
	qui: '',
	sex: '',
	sab: '',
	defaults: {
		'idsemana': null,
		'seg': '',
		'ter': '',
		'qua': '',
		'qui': '',
		'sex': '',
		'sab': ''
	}
});

/**
 * Semana Backbone Collection
 */
model.SemanaCollection = model.AbstractCollection.extend({
	url: 'api/semanas',
	model: model.SemanaModel
});

/**
 * Turma Backbone Model
 */
model.TurmaModel = Backbone.Model.extend({
	urlRoot: 'api/turma',
	idAttribute: 'idturma',
	idturma: '',
	nometurma: '',
	turno: '',
	defaults: {
		'idturma': null,
		'nometurma': '',
		'turno': ''
	}
});

/**
 * Turma Backbone Collection
 */
model.TurmaCollection = model.AbstractCollection.extend({
	url: 'api/turmas',
	model: model.TurmaModel
});

/**
 * Turno Backbone Model
 */
model.TurnoModel = Backbone.Model.extend({
	urlRoot: 'api/turno',
	idAttribute: 'idturno',
	idturno: '',
	horario: '',
	dias: '',
	defaults: {
		'idturno': null,
		'horario': '',
		'dias': ''
	}
});

/**
 * Turno Backbone Collection
 */
model.TurnoCollection = model.AbstractCollection.extend({
	url: 'api/turnos',
	model: model.TurnoModel
});

