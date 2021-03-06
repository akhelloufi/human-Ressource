//  Andy Langton's show/hide/mini-accordion @ http://andylangton.co.uk/jquery-show-hide

// this tells jquery to run the function below once the DOM is ready
$(document).ready(function() {

// choose text for the show/hide link - can contain HTML (e.g. an image)
var showText='recherche avancée';
var hideText='Cacher';

// initialise the visibility check
var is_visible = false;

// append show/hide links to the element directly preceding the element with a class of "toggle"
$('.toggle2').prev().append(' <a href="#" class="toggleLink2">'+showText+'</a>');

// hide all of the elements with a class of 'toggle'
$('.toggle2').hide();

// capture clicks on the toggle links
$('a.toggleLink2').click(function() {

// switch visibility
is_visible = !is_visible;

// change the link text depending on whether the element is shown or hidden
if ($(this).text()==showText) {
$(this).text(hideText);
$(this).parent().next('.toggle2').slideDown('slow');
}
else {
$(this).text(showText);
$(this).parent().next('.toggle2').slideUp('slow');
}

// return false so any link destination is not followed
return false;

});
});