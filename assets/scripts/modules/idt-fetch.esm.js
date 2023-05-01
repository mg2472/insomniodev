/**
 * Fetch requests handler
 * @param data any the data to be sent on the request
 * @param url string optional the url segment to be added to the request base url
 * @param requestConfigs object optional the request configuration object. See the Fetch API Doc to check the values: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
 * @return promise
 **/
async function idtFetchRequest( data, url = '', requestConfigs = {} ) {

    let endpointsBaseUrl = '';

    let headers = new Headers();

    headers.set( 'Content-Type', 'application/json; charset=UTF-8' );

    let fetchConfigs = {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        redirect: 'follow',
        referrerPolicy: 'origin-when-cross-origin',
        body: JSON.stringify( data ),
        headers: headers
    };

    if ( requestConfigs.hasOwnProperty( 'mode' ) ) {
        fetchConfigs.method = requestConfigs.mode;
    }

    if ( requestConfigs.hasOwnProperty( 'cache' ) ) {
        fetchConfigs.cache = requestConfigs.cache;
    }

    if ( requestConfigs.hasOwnProperty( 'credentials' ) ) {
        fetchConfigs.credentials = requestConfigs.credentials;
    }

    if ( requestConfigs.hasOwnProperty( 'redirect' ) ) {
        fetchConfigs.redirect = requestConfigs.redirect;
    }

    if ( requestConfigs.hasOwnProperty( 'referrerPolicy' ) ) {
        fetchConfigs.referrerPolicy = requestConfigs.referrerPolicy;
    }

    if ( requestConfigs.hasOwnProperty( 'body' ) ) {
        fetchConfigs.body = requestConfigs.body;
    }

    if ( requestConfigs.hasOwnProperty( 'headers' ) ) {
        fetchConfigs.headers = new Headers( requestConfigs.headers );
    }

    if ( url === '' ) {
        return;
    } else {
        endpointsBaseUrl = `${url}?action=${data.action}`;
    }

    if ( requestConfigs.hasOwnProperty( 'method' ) ) {
        if ( requestConfigs.method.toLowerCase() === 'get' || requestConfigs.method.toLowerCase() === 'head' ) {
            delete fetchConfigs.body;
        }
        fetchConfigs.method = requestConfigs.method.toUpperCase();
    }

    let request = new Request( endpointsBaseUrl.toString(), fetchConfigs );

    return await fetch( request )
        .then( idtFetchRequestStatusHandler )
        .then( idtFetchRequestFormatResponse )
        .catch( idtFetchRequestErrorsHandler )
}

function idtFetchRequestStatusHandler( response ) {
    if ( response.ok ) {
        return Promise.resolve( response );
    } else {
        return Promise.reject( new Error(response.statusText ) );
    }
}

function idtFetchRequestFormatResponse( response ) {
    return response.json();
}

function idtFetchRequestErrorsHandler( error ) {
    console.log( 'Request error: ', error );
}

export {idtFetchRequest};