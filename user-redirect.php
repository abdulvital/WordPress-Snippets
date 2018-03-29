/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect($redirect_to, $request, $user) {

    $home_url = home_url() . '/';

    if (isset($request) && ($request !== $home_url) && ($request !== '')) {
        // Redirect to requested URL
		return $request;
	} else {
        // Otherwise go home
		return home_url();
	}
}
add_filter('login_redirect', 'my_login_redirect', 10, 3);
