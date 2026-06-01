import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\AuthController::store
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/login/pegawai',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AuthController::store
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AuthController::store
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::store
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AuthController::store
* @see app/Http/Controllers/AuthController.php:67
* @route '/login/pegawai'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

const pegawai = {
    store: Object.assign(store, store),
}

export default pegawai