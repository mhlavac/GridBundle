GridController = ($http) ->
    @http = $http

GridController.$inject = ['$http']

GridController:: =
    init: (serviceId) ->
        self = @
        @http.get('/_grid/' + serviceId)
        .success((result, status) ->
            self.columns    = result.columns
            self.actions    = result.actions
            self.data       = result.data
            self.pagiantor  = result.paginator
            self.totalCount = result.totalCount
            self.name       = result.name
        ).error (data, status) ->
            @status = status
