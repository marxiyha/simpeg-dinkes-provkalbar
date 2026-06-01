import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
import pegawai from './pegawai'
/**
* @see routes/web.php:43
* @route '/login'
*/
export const redirect = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: redirect.url(options),
    method: 'get',
})

redirect.definition = {
    methods: ["get","head"],
    url: '/login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see routes/web.php:43
* @route '/login'
*/
redirect.url = (options?: RouteQueryOptions) => {
    return redirect.definition.url + queryParams(options)
}

/**
* @see routes/web.php:43
* @route '/login'
*/
redirect.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: redirect.url(options),
    method: 'get',
})

/**
* @see routes/web.php:43
* @route '/login'
*/
redirect.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: redirect.url(options),
    method: 'head',
})

/**
* @see routes/web.php:43
* @route '/login'
*/
const redirectForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: redirect.url(options),
    method: 'get',
})

/**
* @see routes/web.php:43
* @route '/login'
*/
redirectForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: redirect.url(options),
    method: 'get',
})

/**
* @see routes/web.php:43
* @route '/login'
*/
redirectForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: redirect.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

redirect.form = redirectForm

/**
* @see \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::store
* @see vendor/laravel/fortify/src/Http/Controllers/AuthenticatedSessionController.php:58
* @route '/login'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/login',
} satisfies RouteDefinition<["post"]>

/**
* @see \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::store
* @see vendor/laravel/fortify/src/Http/Controllers/AuthenticatedSessionController.php:58
* @route '/login'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::store
* @see vendor/laravel/fortify/src/Http/Controllers/AuthenticatedSessionController.php:58
* @route '/login'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::store
* @see vendor/laravel/fortify/src/Http/Controllers/AuthenticatedSessionController.php:58
* @route '/login'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::store
* @see vendor/laravel/fortify/src/Http/Controllers/AuthenticatedSessionController.php:58
* @route '/login'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see routes/web.php:29
* @route '/login/petinggi'
*/
export const petinggi = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: petinggi.url(options),
    method: 'get',
})

petinggi.definition = {
    methods: ["get","head"],
    url: '/login/petinggi',
} satisfies RouteDefinition<["get","head"]>

/**
* @see routes/web.php:29
* @route '/login/petinggi'
*/
petinggi.url = (options?: RouteQueryOptions) => {
    return petinggi.definition.url + queryParams(options)
}

/**
* @see routes/web.php:29
* @route '/login/petinggi'
*/
petinggi.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: petinggi.url(options),
    method: 'get',
})

/**
* @see routes/web.php:29
* @route '/login/petinggi'
*/
petinggi.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: petinggi.url(options),
    method: 'head',
})

/**
* @see routes/web.php:29
* @route '/login/petinggi'
*/
const petinggiForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: petinggi.url(options),
    method: 'get',
})

/**
* @see routes/web.php:29
* @route '/login/petinggi'
*/
petinggiForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: petinggi.url(options),
    method: 'get',
})

/**
* @see routes/web.php:29
* @route '/login/petinggi'
*/
petinggiForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: petinggi.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

petinggi.form = petinggiForm

const login = {
    pegawai: Object.assign(pegawai, pegawai),
}

export default login