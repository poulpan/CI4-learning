<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// we can view the routes in the terminal with the command: "php spark routes"
$routes->get('/', 'Home::index');
/** --commented to use the resource method--
* $routes->get('carslist', 'CarsList::index');
* $routes->get('carslist/(:num)', 'CarsList::show/$1');
*/

// $routes->get('carslist/new', 'CarsList::new');
// $routes->post('carslist/create', 'CarsList::create');
// $routes->get('carslist/edit/(:num)', 'CarsList::edit/$1');
// $routes->post('carslist/update/(:num)', 'CarsList::update/$1');
// $routes->get('carslist/delete/(:num)', 'CarsList::delete/$1');
// $routes->post('carslist/delete/(:num)', 'CarsList::delete/$1');

/* --Making Better Routes Decisions--
**NOTE**: for some reason when I use ci4 HTML spoofing for RESTful routes below, when I set the value for the input it needs to be all caps to work!!!
0) In general we could use add(), but that opens many http methods for routes and it's not recommended as it's unsafe!
1) We could make a single route for get & post delete with match()
2) We can use AutoRouting, but this needs some settings: in the Routing.php we need to change "$autoRoute = true;" and then in the Feature.php we need to change "$autoRoutesImproved = true;". Also we need to make changes in our files, like instead of index method we must do getIndex. Also url_to() function doesn't work with AutoRouting and we need to remove it. In addition all our methods besides index need to be prefixed with the appropriate http verb like getEdit, postUpdate, etc. Lastly we can't mix explicit routes with AutoRouting!
3) We can also have moore readable code in our url_to() Helpers. For example instead of using url_to('CarsList::new') we could rename it here in the routes like $routes->get('carslist/new', 'CarsList::new', ['as' => 'new_carslist']); and use url_to('new_carslist').
4) Another way if we want to spoof a method not supported by the browser, like instead of match post in the delete below, if we wanted to match delete, we can go by:
  a) change the route: $routes->match(['get', 'delete'], 'carslist/delete/(:num)', 'CarsList::delete/$1');
  b) add a hidden field in the delete form like: <input type="hidden" name="_method" value="DELETE">, read **NOTE** above!
  c) in the delete method of the controller we need to check the request to be delete instead of post: if ($this->request->is('delete')) {...}
5) There are 7 standard RESTful routes that combine an Http method with a URL to perform a Crud operation. So to change our routes to RESTful:
  a) the create is not needed, we also need to change it in the new.php file
  b) in the edit to be RESTful the (:num) needs to come before the edit, no changes are needed in our view files
  c) when updating we can use the PUT or PATCH methods and we can remove the /update, need to change the edit.php with CI4 HTML spoofing
  d) making use of RESTful DELETE method, it doesn't include a confirmation method so we split our methods ro cfrmdlt & dlt as ofc our routes
6) and don't forget, we can view the routes in the terminal with the command: "php spark routes"
*/
// $routes->match(['get', 'post'], 'carslist/delete/(:num)', 'CarsList::delete/$1');
// $routes->match(['get', 'delete'], 'carslist/delete/(:num)', 'CarsList::delete/$1');

/** --commented to use the resource method--
* $routes->get('carslist/new', 'CarsList::new', ['as' => 'new_carslist']);
* $routes->post('carslist', 'CarsList::create');
* $routes->get('carslist/(:num)/edit', 'CarsList::edit/$1');
* $routes->patch('carslist/(:num)', 'CarsList::update/$1');
* $routes->get('carslist/(:num)/delete', 'CarsList::confirmDelete/$1');
* $routes->delete('carslist/(:num)', 'CarsList::delete/$1');
*/

/* --Making Better Routes Decisions--
Now that we've made our RESTful routes, instead of defining each of these routes individually, we can create all the routes for a single resource, using the resource method (ci4 documentation: RESTful Resourse Handling):
*/
$routes->resource('carslist', ['controller' => 'CarsList', 'placeholder' => '(:num)']);
$routes->get('carslist/(:num)/delete', 'CarsList::confirmDelete/$1');

/* notes:
1) Be extra careful to specify the name of your controller if it's not a usual naming (Like without specifying CarsList, resource would automatically generate routes for Carslist).
2) By using the resource method we lose the rename we have done before to one of our routes, so we need to fix in our index view the ['as' => 'new_carslist'] from before.
3) Also we need to specify the donfirmDelete route as it's not in the basic resource list of methods!
*/