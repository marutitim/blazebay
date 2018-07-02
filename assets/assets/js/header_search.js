	header_search_download_list();
	var search_results = [];
	
	// LIST DOWNLOAD EVENTS
	$(document).on('ready', header_search_download_list );
	$(document).on('change', '#header_search_type', header_search_download_list);
	$(document).on('click', '#header-search-button', header_search_submit);
	$(document).on('keydown', '#header_search_string', function(e){ if(e.which == 13) { header_search_submit(); e.preventDefault(); } });
	// $(document).on('change', '#header_search_string', header_search_submit });
  
	// DOWNLOAD DATA FROM SERVER
	function header_search_download_list() {
		$('#header_search_type option').each(function(){
			var get = getParam($(this).attr('data-get-var'));
			if(get){
				$('#header_search_string').val(get);
			}
			// $(this).prop('selected', true);
		});
		
		var url = "ajax.php";
		var data = {
			'header_search_type' : $('#header_search_type option:selected').val(),
			// 'header_search_string' : $('#header_search_string').val()
		};
		
		$.post( url, data, header_search_populate_list, 'json');
	}
	
	// POPULATE VARIABLE WITH DOWNLOADED LIST
	function header_search_populate_list( response ) {
		console.log(response);
		search_results = [];
		
		if(response.status) {
			$(response.results).each( function(key, val) {
				search_results.push( val.text );
			});
		}
		
		
	   $( "#header_search_string" ).autocomplete({ source: search_results });
		//$( "#header_search_string" ).attr('placeholder', 'Search here for ' + $('#header_search_type option:selected').attr('data-get-var') + ' ...');

		$( "#header_search_string" ).attr('placeholder', 'Search here for ' + $('#header_search_type option:selected').attr('data-get-var') + ' ...');

		
	}
	
	function header_search_submit() {
		// var path = $('#header_search_type option:selected').attr('data-result-page') + encodeURIComponent($('#header_search_string').val()) + '#result-container';
		
		var path = $('#header_search_type option:selected').attr('data-result-page');

		//if($('#header_search_string').val().length > 0) path = path + '?' + $('#header_search_type option:selected').attr('data-get-var') + '=' + encodeURIComponent($('#header_search_string').val());

		//path = path + '?' + $('#header_search_type option:selected').attr('data-get-holder') + '=' + encodeURIComponent($('#header_search_string').val());
		path = path + '/'+ encodeURIComponent($('#header_search_string').val());

		//path = path + '#result-container';
		// console.log(path);
		window.location.replace(path);
	}
	
	function getParam(name, url) {
		if (!url) {
		  url = window.location.href;
		}
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}