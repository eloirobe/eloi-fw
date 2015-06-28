#Eloi Framework

<em>This is a small and basic framework to start doing a php application.</em>

##How it works
- When the framework starts using the method run from Application, the request is loaded and passed to the routing component.
- The routing component decides, using a yml, json or php configuration file, which controller label is needed to work with this URL.
- The dispatcher component receives the name of the controller and then, using a configuration file in yml format, localizes the path 
of the controller class and instantiates it.
- Once the controller has finished to do the logic, it generates a Response object.
- There are two different types of response:
    - JsonResponse: this response returns a json object.
    - WebResponse: this response returns a html, previously rendered with twig templates.

##Components explanation

- Container: this component lets to instantiate an object calling the method get('clasname'). Previously requires a yml file 
to define the objects and the arguments needed for each one. 
- Controller: it's an interface defining how it must be defined the controller in the application.
- Database: this component manages a mysql database but it's possible to use any other kind of database adding classes that extend of Database.
- Dispatcher: this component receives a controller label and instantiates a controller passing the request.
- Request: is a data object used to pass the data between the different components.
- Response: is a data object used by the controller to generate a response.
- Routing: this component returns, depending on the URL, the controller label.
- View: This component draws the view.
 