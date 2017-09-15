function changeDomainInfo (domain_id, http_host, request_uri, query_string, members, dashboard) {
	$.post(DEFAULT_URL + "/changedomain.php", {
		domain_id: domain_id,
		http_host: http_host,
		request_uri: request_uri,
		query_string: query_string,
		members: members,
		dashboard: dashboard
	}, function (url) {
		window.location = url;
	});
}


