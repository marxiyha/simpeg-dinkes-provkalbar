import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/dinas-luar',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\DinasLuarController::store
* @see app/Http/Controllers/DinasLuarController.php:22
* @route '/dinas-luar'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

const dinasLuar = {
    store: Object.assign(store, store),
}

export default dinasLuar