angular.service "dialog", ($document) ->
    rootScope = this
    body = $document.find("body")
    open: (title, bodyUrl, Controller) ->
        rootScope.$dialog =
            scope: rootScope.$new(Controller)
            src: bodyUrl

        include = $("<ng:include></ng:include")
        include.attr "scope", "$dialog.scope"
        include.attr "src", "$dialog.src"
        dialog = $("<div></div>")
        dialog.append include
        dialog.attr "title", title
        body.append dialog
        dialog.dialog()
        angular.compile(include) rootScope