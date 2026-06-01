import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/cuti/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PengajuanCutiController::store
* @see app/Http/Controllers/PengajuanCutiController.php:18
* @route '/cuti/store'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

const PengajuanCutiController = { store }

export default PengajuanCutiController