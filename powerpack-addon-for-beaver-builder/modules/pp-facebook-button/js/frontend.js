;(function ($) {

	PPFacebookButton = function (settings) {
		this.id = settings.id;
		this.node = $('.fl-node-' + settings.id)[0];
		this.settings = settings;

		this._init();
	};

	PPFacebookButton.prototype = {
		id: '',
		node: '',
		settings: {},

		_init: function ()
		{
			this._initSDK();
			this._parse();

			$('body').on( 'change', '.fl-builder-pp-facebook-button-settings #fl-field-button_type select', this._actionChange.bind( this ) );
			$('body').on( 'change', '.fl-builder-pp-facebook-button-settings #fl-field-layout select', this._layoutChange.bind( this ) );
			$('body').on( 'change', '.fl-builder-pp-facebook-button-settings #fl-field-size input', this._sizeChange.bind( this ) );
			$('body').on( 'change', '.fl-builder-pp-facebook-button-settings #fl-field-color_scheme input', this._schemeChange.bind( this ) );
			$('body').on( 'change', '.fl-builder-pp-facebook-button-settings #fl-field-show_share input', this._shareChange.bind( this ) );
			$('body').on( 'change', '.fl-builder-pp-facebook-button-settings #fl-field-show_faces input', this._facesChange.bind( this ) );
			$('body').on( 'change', '.fl-builder-pp-facebook-button-settings #fl-field-url_type input', this._urlTypeChange.bind( this ) );
			$('body').on( 'change', '.fl-builder-pp-facebook-button-settings #fl-field-url input', this._urlChange.bind( this ) );
		},

		_initSDK: function()
		{
			if ( $( '#fb-root' ).length === 0 ) {
				$('body').prepend('<div id="fb-root"></div>');
			}

			var d = document, s = 'script', id = 'facebook-jssdk';
			var js, fjs = d.getElementsByTagName(s)[0];
			
			if (d.getElementById(id)) return;
			
			js = d.createElement(s); js.id = id;
			js.src = this.settings.sdkUrl;
			fjs.parentNode.insertBefore(js, fjs);
		},

		_actionChange: function(e)
		{
			e.stopPropagation();

			this._update( { 'data-action' : $(e.target).val() } );
		},

		_layoutChange: function(e)
		{
			e.stopPropagation();

			this._update( { 'data-layout' : $(e.target).val() } );
		},

		_sizeChange: function(e)
		{
			e.stopPropagation();

			this._update( { 'data-size' : $(e.target).val() } );
		},

		_schemeChange: function(e)
		{
			e.stopPropagation();

			this._update( { 'data-colorscheme' : $(e.target).val() } );
		},

		_shareChange: function(e)
		{
			e.stopPropagation();

			var value = ( 'yes' === $(e.target).val() ) ? true : false;

			this._update( { 'data-share' : value } );
		},

		_facesChange: function(e)
		{
			e.stopPropagation();

			var value = ( 'yes' === $(e.target).val() ) ? true : false;

			this._update( { 'data-show-faces' : value } );
		},

		_urlTypeChange: function(e)
		{
			e.stopPropagation();

			var customUrl = $(e.target).parents('.fl-form-table').find('#fl-field-url input[name="url"]').val();
			var value = ( 'current_page' === $(e.target).val() ) ? this.settings.currentUrl : customUrl;

			this._update( { 'data-href' : value } );
		},

		_urlChange: function(e)
		{
			e.stopPropagation();

			this._update( { 'data-href' : $(e.target).val() } );
		},

		_update: function(attr)
		{	
			$(this.node).find('.pp-facebook-widget').attr(attr);

			this._parse();
		},
		
		_parse: function()
		{
			var node = this.node;

			// FB SDK is loaded, parse only current element
			if ('undefined' !== typeof FB) {
				FB.XFBML.parse(node);
			}
		}
	};

})(jQuery);