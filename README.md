beer-map
========
Denver Beer map was created using PHP, MySQL, Apache, Javascript/jQuery, CSS3, and HTML5 and the Google Maps V3 API.
On page load an Ajax call is made to grab information about each brewery from the database.
Brewery information is passed from the server to the client in XML format.
Javascript is used to parse the XML document and place markers on the google map along with a listing of breweries.
The InfoBubble library is used to place custom styles on the InfoWindow when each icon is clicked.
