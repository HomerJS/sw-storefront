import { COOKIE_CONFIGURATION_UPDATE } from 'src/plugin/cookie/cookie-configuration.plugin';

document.$emitter.subscribe(COOKIE_CONFIGURATION_UPDATE, eventCallback);

function eventCallback(updatedCookies) {
    let cookieActive = updatedCookies.detail['cookie-key-1'];
    if (typeof updatedCookies.detail['cookie-key-1'] !== 'undefined') {
        // The cookie with the cookie attribute "cookie-key-1" either is set active or from active to inactive

        console.log('Not updated: ' + cookieActive);
    } else {
        console.log('Updated: ' + cookieActive);
    }
}